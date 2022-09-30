let user = document.head.querySelector('meta[name="user"]');

module.exports = {
	computed: {
		currentUser(){
			return JSON.parse(user.content);
		},
		isAuthenticated(){
			return !! user.content;
		},
		guest(){
			return ! this.isAuthenticated
		}
	},
	methods:{
		redirectIfGuest(){
			if (this.guest) {
				return window.location.href = '/login';
			}
		}
	}
};