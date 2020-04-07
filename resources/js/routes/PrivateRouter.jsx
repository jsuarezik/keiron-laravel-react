import React from "react";
import { Route, Redirect } from "react-router-dom";
import { getUserStorage } from "services/localStorage/userStorage";
import { validateLentObject } from "utils/utils";

const PrivateRoute = ({ component: Component, ...rest }) => {
	const isAuthenticated = () => validateLentObject(getUserStorage());

	return (
		<Route
			{...rest}
			render={props => {
				return isAuthenticated() ? (
					<Redirect
						to={{
							pathname: "/"
						}}
					/>
				) : (
					<Component {...props} />
				);
			}}
		/>
	);
};

export default PrivateRoute;
