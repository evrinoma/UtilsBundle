window.onload = () => {
    let swagger = document.getElementById('swagger-data');
    if (swagger != undefined) {
        let load = JSON.parse(document.getElementById('swagger-data').innerText);

        if (load.spec !== undefined && load.spec.components !== undefined) {
            $.each(load.spec.paths, function (keyPath, valueREST) {
                $.each(valueREST, function (keyParameters, valueParameters) {
                    if (valueParameters.parameters !== undefined) {
                        $.each(valueParameters.parameters, function (keyItems, valueItems) {
                            if (valueItems.style === 'form' && valueItems.schema !== undefined && valueItems.schema.items !== undefined) {
                                let items = valueItems.schema.items;
                                if (items !== undefined && items.$ref !== undefined) {
                                    let formTypeName = items.$ref.replace('#/components/schemas/', '');
                                    if (load.spec.components.schemas[formTypeName].properties !== undefined) {
                                        $.each(load.spec.components.schemas[formTypeName].properties, function (key, value) {
                                            if (value.enum !== undefined) {
                                                let items = {default: value.default !== undefined ? value.default : '', enum: value.enum, type: "string"};
                                                load.spec.paths[keyPath][keyParameters].parameters[keyItems].schema.items = items;
                                            }
                                        });
                                    } else {
                                        return true;
                                    }
                                }
                            } else {
                                return true;
                            }
                        });
                    } else {
                        return true;
                    }
                });
            });

        }
        const data = load;

        // const myPlugin = {
        //     components: {
        //         TryItOutButton: () => {
        //             // NOTE: We're not handling the click event for brevity.
        //             return
        //                '<div className="try-out"><button className="btn try-out__btn">Just do it!</button></div>';
        //
        //         }
        //     }
        // }

        // const HideTopbarPlugin = {
        //     // this plugin overrides the Topbar component to return nothing
        //     components: {
        //         Topbar: () => {
        //             return null
        //         }
        //     }
        // }

        const ui = SwaggerUIBundle({
            spec: data.spec,
            dom_id: '#swagger-ui',
            validatorUrl: null,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            presets_config: {
                SwaggerUIStandalonePreset: {
                    TopbarPlugin: false
                }
            },
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
                // myPlugin,
                // HideTopbarPlugin
            ],
            layout: 'StandaloneLayout'
        });

        const storageKey = 'nelmio_api_auth';

        // if we have auth in storage use it
        if (sessionStorage.getItem(storageKey)) {
            try {
                ui.authActions.authorize(JSON.parse(sessionStorage.getItem(storageKey)));
            } catch (ignored) {
                // catch any errors here so it does not stop script execution
            }
        }

        // hook into authorize to store the auth in local storage when user performs authorization
        const currentAuthorize = ui.authActions.authorize;
        ui.authActions.authorize = function (payload) {
            sessionStorage.setItem(storageKey, JSON.stringify(payload));
            return currentAuthorize(payload);
        };

        // hook into logout to clear auth from storage if user logs out
        const currentLogout = ui.authActions.logout;
        ui.authActions.logout = function (payload) {
            sessionStorage.removeItem(storageKey);
            return currentLogout(payload);
        };

        window.ui = ui;
    }
};
