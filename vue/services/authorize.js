export default {

	isAdmin() {
		var cookieAuth = cookie.get('auth')
		if (cookieAuth) {
			return JSON.parse(cookieAuth).is_admin;
		} else {
			window.location.reload();
		}
	}

}