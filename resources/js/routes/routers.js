// pages for this product
import EcommercePage from "views/EcommercePage/EcommercePage";
import LoginPage from "views/LoginPage/LoginPage";
import ProfilePage from "views/ProfilePage/ProfilePage";
import ProductPage from "views/ProductPage/ProductPage";
import ShoppingCartPage from "views/ShoppingCartPage/ShoppingCartPage";
import ErrorPage from "views/ErrorPage/ErrorPage";
import SignUpPage from "views/SignupPage/SignupPage";
import LandingPage from "views/LandingPage/LandingPage";

import CheckoutPage from "views/Checkout/CheckoutPage";
import RespuestaCanjePage from "views/RespuestaCanjePage/RespuestaCanjePage";
import WaitPage from "views/WaitPage/WaitPage";
import SearchPage from "views/SearchPage/SearchPage";
import { NewPassword } from "views/ChangePassword/NewPassword";
import { ForgotPassword } from "views/ChangePassword/ForgotPassword";
import PreguntasFrecuentes from "views/InfoPages/PreguntasFrecuentes";
import TerminosCondiciones from "views/InfoPages/TerminosCondiciones";

/**
 * @Structuras de las rutas: {
 *      @exact : si la ruta tiene que ser excrita exactamente para que cargue el componente !!
 *      @path : El url que se muestra en el navegador !!
 *      @component : el componente a cargar cuando haga match en la ruta(path) !!
 *      @privateNoLogin : Las rutas que solo pueden ser accedidas cuando no se esta logeado !!
 *      @privateLogin : Las rutas que solo pueden ser accedidas cuando se esta logueado !!
 * }
 */
export default [
    {
        exact: true,
        path: "/",
        component: LandingPage
    },
    {
        exact: true,
        path: "/autologin",
        component: LandingPage
    },
    {
        path: "/tienda/:category",
        component: EcommercePage
    },
    {
        path: "/perfil",
        component: ProfilePage
    },
    {
        path: "/producto/:id",
        component: ProductPage
    },
    {
        path: "/carrito",
        component: ShoppingCartPage
    },
    {
        path: "/login",
        component: LoginPage,
        privateNoLogin: true
    },
    {
        path: "/registro",
        component: SignUpPage,
        privateNoLogin: true
    },
    {
        // @OJO solo se puede acceder cuando se esta logueado
        path: "/checkout",
        component: CheckoutPage,
        privateLogin: true
    },
    {
        path: "/respuesta",
        component: RespuestaCanjePage,
        privateLogin: true
    },
    {
        path: "/espera",
        component: WaitPage,
        privateLogin: true
    },
    {
        path: "/nueva/clave",
        component: NewPassword,
        privateNoLogin: true
    },
    {
        path: "/olvido/clave",
        component: ForgotPassword,
        privateNoLogin: true
    },
    {
        path: "/busqueda/:s",
        component: SearchPage
    },
    {
        path: "/preguntasfrecuentes",
        component: PreguntasFrecuentes
    },
    {
        path: "/terminosycondiciones",
        component: TerminosCondiciones
    },
    {
        component: ErrorPage
    }
];
