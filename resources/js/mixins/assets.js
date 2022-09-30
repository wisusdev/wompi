module.exports = {
	methods: {
		asset(path) {
			let base_path = window._asset || '';
			return base_path + path;
		}
	}
}