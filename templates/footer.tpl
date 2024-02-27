		<script>
		// Check if 'msg' parameter is present in the URL
		if (window.location.search.includes('msg=')) {
			// Get the value of 'msg' parameter from the URL
			const params = new URLSearchParams(window.location.search);
			const message = params.get('msg');

			// Create a Bootstrap alert element
			const alertDiv = document.createElement('div');
			alertDiv.className = 'alert alert-success';
			alertDiv.innerHTML = message;

			// Add the alert to the top of the page 
			document.body.insertBefore(alertDiv, document.body.firstChild);

			// Automatically close the alert after 5 seconds
			setTimeout(function() {
				alertDiv.remove();
			}, 5000);
		}
		</script>
	</body>
</html>