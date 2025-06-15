document.addEventListener('DOMContentLoaded', () => {
    const paymentMessage = document.getElementById('payment-message');
    const totalAmountElement = document.querySelector('.total span:last-child'); // Para obtener el total

    if (typeof paypal === 'undefined') {
        paymentMessage.textContent = 'Error: PayPal SDK no cargado. Revisa tu Client ID en pago.php.';
        paymentMessage.classList.add('error');
        return;
    }

    const totalCompraText = totalAmountElement ? totalAmountElement.textContent.replace('$', '').replace(',', '') : '0';
    const totalCompra = parseFloat(totalCompraText);

    if (totalCompra <= 0) {
        paymentMessage.textContent = 'No hay un monto válido para procesar el pago. Por favor, agrega productos al carrito.';
        paymentMessage.classList.add('error');
        const paypalContainer = document.getElementById('paypal-button-container');
        if (paypalContainer) {
            paypalContainer.style.display = 'none';
        }
        return;
    }

    paypal.Buttons({
        style: {
            layout: 'vertical',
            color: 'blue',
            shape: 'rect',
            label: 'paypal',
            height: 40
        },

        createOrder: function(data, actions) {
            paymentMessage.textContent = 'Creando orden en PayPal...';
            paymentMessage.classList.add('info');

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: totalCompra.toFixed(2),
                        currency_code: 'MXN'
                    },
                    description: 'Compra en Tempo - ' + new Date().toLocaleString(),
                }]
            });
        },

        onApprove: function(data, actions) {
            paymentMessage.textContent = 'Pago aprobado en PayPal. Verificando la transacción...';
            paymentMessage.classList.add('info');

            // Captura la orden. Esta llamada DEBE hacerse desde tu servidor (PHP)
            // para mayor seguridad y para registrar la transacción en tu base de datos.
            // Aquí la hacemos en el cliente por simplicidad de la demo, pero la verificación y registro
            // final siempre debe ser en el servidor.
            return actions.order.capture().then(function(details) {
                console.log('Transacción capturada por PayPal:', details);

                if (details.status === 'COMPLETED') {
                    paymentMessage.textContent = '¡Pago completado con éxito! Registrando orden y enviando correo...';
                    paymentMessage.classList.add('success');

                    // --- LLAMADA AJAX A TU SCRIPT PROCESADOR DE ORDEN ---
                    // Enviamos el ID de la orden de PayPal y los detalles al servidor PHP
                    fetch('procesar_orden.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID, // ID de la orden de PayPal (para verificar en backend)
                            paypalDetails: details // Detalles completos de la transacción (para extraer email/nombre)
                        })
                    })
                        .then(response => response.json())
                        .then(serverData => {
                            if (serverData.success) {
                                paymentMessage.textContent = serverData.message || 'Orden registrada y correo enviado. Redireccionando al ticket...';
                                paymentMessage.classList.add('success');
                                // Redirigir a ticket.php con el ID del pedido generado por tu servidor
                                setTimeout(() => {
                                    window.location.href = 'ticket.php?id_pedido=' + serverData.id_pedido;
                                }, 1500);
                            } else {
                                paymentMessage.textContent = serverData.message || 'Error al registrar la orden en nuestro sistema. Contacta a soporte.';
                                paymentMessage.classList.add('error');
                                console.error('Error del servidor:', serverData.error);
                                // Aquí podrías querer implementar un flujo de reembolso si la orden de PayPal
                                // se completó pero tu sistema no pudo registrarla.
                            }
                        })
                        .catch(error => {
                            paymentMessage.textContent = 'Error de comunicación con el servidor al registrar la orden.';
                            paymentMessage.classList.add('error');
                            console.error('Error de fetch a procesar_orden.php:', error);
                        });

                } else {
                    paymentMessage.textContent = 'El pago no se pudo completar. Estado: ' + details.status;
                    paymentMessage.classList.add('error');
                    console.error('Estado de transacción PayPal no COMPLETED:', details);
                }
            }).catch(function(err) {
                paymentMessage.textContent = 'Hubo un error al capturar el pago en PayPal. Por favor, intenta de nuevo.';
                paymentMessage.classList.add('error');
                console.error('Error al capturar la orden en PayPal (cliente-side):', err);
            });
        },

        onError: function(err) {
            paymentMessage.textContent = 'Ha ocurrido un error con el proceso de PayPal. Por favor, intenta de nuevo.';
            paymentMessage.classList.add('error');
            console.error('Error de PayPal SDK:', err);
        },

        onCancel: function(data) {
            paymentMessage.textContent = 'El pago con PayPal ha sido cancelado.';
            paymentMessage.classList.add('info');
            console.log('Pago cancelado:', data);
        }

    }).render('#paypal-button-container');
});