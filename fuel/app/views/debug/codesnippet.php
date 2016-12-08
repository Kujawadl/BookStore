<pre class='pre-scrollable hljs <?php if(isset($Language)) {echo $Language;}?>'>
  <?php
    try {
      echo htmlentities(var_export($Code, true));
    } catch (Exception $e) {
      echo "An error occurred parsing the code snippet: \n\n" . $e->getMessage();
    }
  ?>
</pre>
