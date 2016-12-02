<pre class='pre-scrollable hljs <?php if(isset($Language)) {echo $Language;}?>'>
  <?php
    try {
      echo htmlentities((is_object($Code)) ? var_export($Code, true) : $Code);
    } catch (Exception $e) {
      echo "An error occurred parsing the code snippet: \n\n" . $e->getMessage();
    }
  ?>
</pre>
