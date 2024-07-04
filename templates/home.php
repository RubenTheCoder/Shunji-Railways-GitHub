<!DOCTYPE html>

<html lang="<?= cleanHTML($page_lang) ?>">

  <head>
    <!-- ████████████████████████████████ -->
    <!-- ██ SEO Content                ██ -->
    <!-- ████████████████████████████████ -->

    <title>Shunji Railways</title>
  </head>

  <body>
    <h1>Page template test</h1>
    <h3>Site lang code: [<?= cleanHTML($page_lang) ?>]</h3>
  </body>

  <div class="scripts-after">
    <!-- Google tag (gtag.js) -->
    <script async
      src="https://www.googletagmanager.com/gtag/js?id=G-PMNB368N3X"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() { dataLayer.push(arguments); }
      gtag('js', new Date());

      gtag('config', 'G-PMNB368N3X');
    </script>
  </div>

</html>