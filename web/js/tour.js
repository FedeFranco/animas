var tour = new Tour({
          storage: window.localStorage,
            steps: [
                    {
                        element: "#icon-logo-animas",
                        title: "Bienvenido a Animas!",
                        content: "Te damos la bienvenida a la plataforma web de Animas, plataforma para la protección animal de carácter social-comunitario"
                    },
                    {
                        element: "#text-seek",
                        title: "Búsqueda indirecta.",
                        content: "De esta manera podrás teclear alguna palabra que te interesa en un anuncio"
                    },
                    {
                        element: "#bot-comprobar-cercanos",
                        title: "Comprueba publicaciones cerca de ti!",
                        content: "Aquí podrás encontrar publicaciones que han ocurrido cerca de ti"
                    },
                    {
                        element: "#publicar-anim",
                        title: "Publica en Animas!",
                        content: "Publica un anuncio donde das a conocer a qué mascota quieres ayudar y la ubicación donde ocurre para que otros usuarios puedan ayudarte"
                    },
                    {
                        element: "#busqueda-anim",
                        title: "Filtra publicaciones que puedan interesarte!",
                        content: "Aquí podrás filtrar publicaciones por Categoría o por Familia de animal"
                    },
                    {
                        element: "#sobre-anim",
                        title: "Más de nosotros!",
                        content: "Si tienes alguna duda de cómo funciona Animas no olvides visitar esa sección."
                    },
                    {
                        element: "#login-anim",
                        title: "Por último no olvides registrarte!",
                        content: "Si no te has unido a la comunidad Animas no sabemos a qué esperas! Descubre todo lo que puede ofrecerte Animas siendo usuario. ¡Te esperamos!"
                    }
        ],
        template: "<div class='popover tour'> <div class='arrow'></div>  <h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-default' data-role='prev'>« Anterior</button><span data-role='separator'>|</span><button class='btn btn-default' data-role='next'>Siguiente »</button></div><button class='btn btn-default' data-role='end' style='padding: 5px;'>Finalizar</button></div>"
        });

        // Initialize the tour
        tour.init();

        // Start the tour
        tour.start();
