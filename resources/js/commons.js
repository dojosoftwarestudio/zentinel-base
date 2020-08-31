export default {
    data() {
        return {}
    },
    methods: {
		callApi: async function (method, url, dataInput) {
			try {
				return await axios({
					method: method,
					url: url,
					data: dataInput
				})
			}
			catch (e) {
				return e.response
			}
		},
    },
}