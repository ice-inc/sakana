<h1>Basic Example with External JSX</h1>
<div id="container">
  <p>
    If you can see this, React is not working right. This is probably because you&apos;re viewing
    this on your file system instead of a web server. Try running
    <pre>
      python -m SimpleHTTPServer
    </pre>
    and going to <a href="http://localhost:8000/">http://localhost:8000/</a>.
  </p>
</div>
<h4>Example Details</h4>
<p>This is written with JSX in a separate file and transformed in the browser.</p>
<p>
  Learn more about React at
  <a href="https://facebook.github.io/react" target="_blank">facebook.github.io/react</a>.
</p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
<script type="text/babel">
  <?= render('examples/basic-jsx-external/example.js') ?>
</script>
