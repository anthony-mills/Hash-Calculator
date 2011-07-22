$().ready(function() {
	$("#createHash").validate({
		messages: {
			hash_string: " Please enter a string to hash",
		}
	})
});
