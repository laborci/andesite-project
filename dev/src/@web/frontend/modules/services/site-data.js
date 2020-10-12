class SiteData {
	static read(key){
		if(typeof this.__value === 'undefined'){
			let base64 = document.querySelector('meta[name="site-data"]').getAttribute('content');
			let json = new Buffer(base64, 'base64')
			this.__value = JSON.parse(json)
		}
		return this.__value[key];
	}
}

export default SiteData;