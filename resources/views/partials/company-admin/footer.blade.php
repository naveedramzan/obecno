<footer class="footer" style="margin-top:100px;">
    <div class="col-12">
        <center>
            <p>&copy;copyright <a href="https://obecno.com">www.obecno.com</a> 2025</p>
        </center>
    </div>
</footer>
<script src="/front/js/jquery371.js" type="text/javascript"></script>
<script>
// Session timeout handling
(function() {
    // Intercept AJAX requests to detect 401 (Unauthorized) responses
    const originalFetch = window.fetch;
    window.fetch = function(...args) {
        return originalFetch.apply(this, args)
            .then(response => {
                // If we get a 401, session has expired
                if (response.status === 401) {
                    window.location.href = '{{ route("logout") }}';
                }
                return response;
            })
            .catch(error => {
                // Handle network errors that might indicate session issues
                if (error.message && error.message.includes('401')) {
                    window.location.href = '{{ route("logout") }}';
                }
                throw error;
            });
    };

    // Also handle jQuery AJAX requests if jQuery is available
    if (typeof jQuery !== 'undefined') {
        $(document).ajaxError(function(event, xhr, settings) {
            if (xhr.status === 401) {
                window.location.href = '{{ route("logout") }}';
            }
        });
    }

    // Handle form submissions that might fail due to session timeout
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.tagName === 'FORM') {
            const originalSubmit = form.onsubmit;
            form.addEventListener('submit', function(event) {
                // This will be handled by the fetch interceptor above
            }, true);
        }
    }, true);
})();
</script>
