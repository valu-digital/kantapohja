<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
        (function (d) {
            var config = {
                    kitId: 'ypu7umg',
                    scriptTimeout: 3000,
                    async: true
                },
                h = d.documentElement, t = setTimeout(function () {
                    h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
                }, config.scriptTimeout), tk = d.createElement("script"), f = false, s = d.getElementsByTagName("script")[0], a;
            h.className += " wf-loading";
            tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
            tk.async = true;
            tk.onload = tk.onreadystatechange = function () {
                a = this.readyState;
                if (f || a && a != "complete" && a != "loaded")return;
                f = true;
                clearTimeout(t);
                try {
                    Typekit.load(config)
                } catch (e) {
                }
            };
            s.parentNode.insertBefore(tk, s)
        })(document);
	</script>
	<style type="text/css">
		.wf-loading .menu-item,
		.wf-loading h1,
		.wf-loading h2,
		.wf-loading h3,
		.wf-loading h4,
		.wf-loading h5,
		.wf-loading h6,
		.wf-loading p,
		.wf-loading a,
		.wf-loading button,
		.wf-loading li {
			/* Hide the blog title and post titles while web fonts are loading */
			visibility: hidden !important;
		}
	</style>
	<?php wp_head(); ?>
</head>
