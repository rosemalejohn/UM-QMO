<template>
	<form @submit.prevent="login()" class="login-form" method="post">
        <h3 class="form-title">Sign In</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>Enter any username and password.</span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase">Login</button>
            <label class="rememberme check">
                <input type="checkbox" name="remember" value="1" />Remember 
            </label>
        </div>
        <div class="create-account">
            <p>
                <a href="javascript:;" id="forget-password" class="uppercase">Forgot Password</a>
            </p>
        </div>
    </form>
</template>

<script>
	export default {

		methods: {

			login() {
				
			}
			
		}

	}
</script>