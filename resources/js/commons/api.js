export default {
    data() {
        return {}
    },
    methods: {
		callApi: async function (method, prefix, url, dataInput) {
			try {
				return await axios({
					method: method,
					url: prefix + url,
					data: dataInput
				})
			}
			catch (e) {
				return e.response
			}
		},
    },
}
