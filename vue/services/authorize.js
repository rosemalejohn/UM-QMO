export default {

	isAdmin() {
		var auth = JSON.parse(cookie.get('auth'))
		return auth.is_admin
	}

}