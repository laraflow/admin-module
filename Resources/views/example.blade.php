<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Example</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('modules/admin/assets/css/custom-switch.css') }}" rel="stylesheet">
</head>
<body class="h-100">
  <div class="container h-100">
    <div class="d-flex align-items-start flex-column h-100">
      <div class="w-100 m-auto py-5 text-center">

        <div class="custom-switch pl-0">
          <input class="custom-switch-input" id="example_01" type="checkbox">
          <label class="custom-switch-btn" for="example_01"></label>
        </div>

        <hr>

        <div class="custom-switch custom-switch-label-io pl-0">
          <input class="custom-switch-input" id="example_02" type="checkbox">
          <label class="custom-switch-btn" for="example_02"></label>
        </div>

        <hr>

        <div class="custom-switch custom-switch-label-onoff pl-0">
          <input class="custom-switch-input" id="example_03" type="checkbox">
          <label class="custom-switch-btn" for="example_03"></label>
        </div>

        <hr>

        <div class="custom-switch custom-switch-primary pl-0">
          <input class="custom-switch-input" id="example_04" type="checkbox">
          <label class="custom-switch-btn" for="example_04"></label>
        </div>

        <hr>

        <div class="custom-switch custom-switch-label-status pl-0">
          <input class="custom-switch-input" id="example_05" type="checkbox">
          <label class="custom-switch-btn" for="example_05"></label>
        </div>

        <hr>

        <div class="custom-switch custom-switch-label-onoff custom-switch-sm pl-0">
          <input class="custom-switch-input" id="example_06" type="checkbox">
          <label class="custom-switch-btn" for="example_06"></label>
        </div>
        <p class="my-2">I'm <code>custom-switch-sm</code></p>

        <hr>

        <div class="custom-switch custom-switch-label-onoff custom-switch-xs pl-0">
          <input class="custom-switch-input" id="example_07" type="checkbox">
          <label class="custom-switch-btn" for="example_07"></label>
        </div>
        <p class="my-2">I'm <code>custom-switch-xs</code></p>

        <hr>

        <div class="custom-switch custom-switch-label-yesno pl-0">
          <input class="custom-switch-input" id="example_08" type="checkbox">
          <label class="custom-switch-btn" for="example_08"></label>
          <div class="custom-switch-content-checked my-3">
            <span class="text-success">I'm checked</span>
          </div>
          <div class="custom-switch-content-unchecked my-3">
            <span class="text-danger">I'm unchecked (click me!)</span>
          </div>
        </div>

        <hr>

        <div class="custom-switch pl-0">
          <input class="custom-switch-input" id="example_09" type="checkbox" required>
          <label class="custom-switch-btn" for="example_09"></label>
        </div>
        <p class="my-2">I'm <code>required</code></p>

        <hr>

        <div class="custom-switch pl-0">
          <input class="custom-switch-input" id="example_10" type="checkbox" disabled>
          <label class="custom-switch-btn" for="example_10"></label>
        </div>
        <br>
        <div class="custom-switch pl-0">
          <input class="custom-switch-input" id="example_11" type="checkbox" checked disabled>
          <label class="custom-switch-btn" for="example_11"></label>
        </div>
        <p class="my-2">I'm <code>disabled</code></p>

        <hr>

        <div class="form-group">
          <label for="example_12">I'm a &lt;label&gt; and can be clicked:</label>
          <div class="custom-switch pl-0">
            <input type="checkbox" class="custom-switch-input" id="example_12" checked>
            <label class="custom-switch-btn text-hide" for="example_12">{value}</label>
          </div>
        </div>

        <hr>
        <legend>Validation</legend>
        <form class="was-validated">
          <div class="form-group is-invalid">
            <div class="custom-switch pl-0">
              <input class="custom-switch-input" id="example_13" type="checkbox">
              <label class="custom-switch-btn" for="example_13"></label>
            </div>
          </div>
        </form>
        <p class="my-2">I'm <code>invalid</code></p>

      </div>
    </div>
  </div>
</body>
</html>
