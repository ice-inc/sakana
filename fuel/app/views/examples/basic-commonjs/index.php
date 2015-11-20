<h1>Basic CommonJS Example with Browserify</h1>
<div id="container">
  <p>
    To install React, follow the instructions on
    <a href="https://github.com/facebook/react/">GitHub</a>.
  </p>
  <p>
    If you can see this, React is not working right.
    If you checked out the source from GitHub make sure to run <code>grunt</code>.
  </p>
</div>
<h4>Example Details</h4>
<p>This is written with JSX in a CommonJS module and precompiled to vanilla JS by running:</p>
<pre>npm start</pre>
<p>
  Learn more about React at
  <a href="https://facebook.github.io/react" target="_blank">facebook.github.io/react</a>.
</p>
<script>
  <?= render('examples/basic-commonjs/bundle.js') ?>
</script>
