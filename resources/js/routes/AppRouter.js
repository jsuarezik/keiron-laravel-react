import React, { Fragment } from "react";
import { createBrowserHistory } from "history";
import { Route, Switch } from "react-router";
import { BrowserRouter as Router } from "react-router-dom";
// style
import "assets/scss/material-kit-pro-react.scss?v=1.8.0";

// custom components
import PrivateRoute from "./PrivateRouter";
import HeaderCustom from "components/Header/HeaderCustom";
import FooterGlobal from "views/Footer/FooterGlobal";

// routes
import routers from "./routers";
import PrivateLoginRouter from "./PrivateLoginRouter";

var hist = createBrowserHistory();

const AppRouter = () => {
    return (
        <Router history={hist} basename="prueba">
            <Fragment>
                <HeaderCustom />

                <Switch>
                    {routers.map(route => {
                        if (route.hasOwnProperty("privateNoLogin")) {
                            return (
                                <PrivateRoute
                                    key={`router-${route.path}`}
                                    {...route}
                                />
                            );
                        } else if (route.hasOwnProperty("privateLogin")) {
                            return (
                                <PrivateLoginRouter
                                    key={`router-${route.path}`}
                                    {...route}
                                />
                            );
                        } else {
                            return (
                                <Route
                                    key={`router-${route.path}`}
                                    {...route}
                                />
                            );
                        }
                    })}
                </Switch>
                <FooterGlobal />
            </Fragment>
        </Router>
    );
};

export default AppRouter;
