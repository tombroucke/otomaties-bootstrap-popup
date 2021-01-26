import Cookie from './cookie';

jQuery(document).ready(function($){
	let cookie;
	if( $('#otomatiesModal').length ) {
		const show_once = $('#otomatiesModal').attr('data-showonce');
		if( show_once ) {
			cookie = new Cookie("saw_" + show_once)

			if( cookie.get() != "" ) {
				return false;
			}

			cookie.set(this.show_once)
		}
		$('#otomatiesModal').modal('show')
	}
});
