<div class="row">
    <div class="col-md-9">

        <div class="docs-demo">
            <div class="img-container">
                <img src="assets/media/page-title.jpg" alt="Picture" id="imageGaleria">
            </div>
        </div>
    </div>
    <div class="col-md-3">

        <div class="docs-preview clearfix">
            <div class="img-preview preview-lg"></div>
        </div>

        <div class="docs-data">
            <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataX">X</label>
            </span>
                <input type="text" class="form-control" id="dataX" placeholder="x">
                <span class="input-group-append">
              <span class="input-group-text">px</span>
            </span>
            </div>
            <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataY">Y</label>
            </span>
                <input type="text" class="form-control" id="dataY" placeholder="y">
                <span class="input-group-append">
              <span class="input-group-text">px</span>
            </span>
            </div>
            <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataWidth">Width</label>
            </span>
                <input type="text" class="form-control" id="dataWidth" placeholder="width">
                <span class="input-group-append">
              <span class="input-group-text">px</span>
            </span>
            </div>
            <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataHeight">Height</label>
            </span>
                <input type="text" class="form-control" id="dataHeight" placeholder="height">
                <span class="input-group-append">
              <span class="input-group-text">px</span>
            </span>
            </div>
            <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataRotate">Rotate</label>
            </span>
                <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                <span class="input-group-append">
              <span class="input-group-text">deg</span>
            </span>
            </div>
            <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataScaleX">ScaleX</label>
            </span>
                <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
            </div>
            <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataScaleY">ScaleY</label>
            </span>
                <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
            </div>
        </div>
    </div>
</div>
<div class="row" id="actions">
    <div class="col-md-9 docs-buttons">
        <!-- <h3>Toolbar:</h3> -->

        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
              <span class="fa fa-search-plus"></span>
            </span>
            </button>
            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
            </button>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0"
                    title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
              <span class="fa fa-arrow-left"></span>
            </span>
            </button>
            <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0"
                    title="Move Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
              <span class="fa fa-arrow-right"></span>
            </span>
            </button>
            <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10"
                    title="Move Up">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
              <span class="fa fa-arrow-up"></span>
            </span>
            </button>
            <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10"
                    title="Move Down">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
              <span class="fa fa-arrow-down"></span>
            </span>
            </button>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
              <span class="fa fa-undo-alt"></span>
            </span>
            </button>
            <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
              <span class="fa fa-redo-alt"></span>
            </span>
            </button>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleX(-1)">
              <span class="fa fa-arrows-alt-h"></span>
            </span>
            </button>
            <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleY(-1)">
              <span class="fa fa-arrows-alt-v"></span>
            </span>
            </button>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.crop()">
              <span class="fa fa-check"></span>
            </span>
            </button>
            <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.clear()">
              <span class="fa fa-times"></span>
            </span>
            </button>
        </div>


        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.reset()">
              <span class="fa fa-sync-alt"></span>
            </span>
            </button>
        </div>


        <!-- <h3>Toggles:</h3> -->
        <div class="btn-group mt-2 docs-toggles" data-toggle="buttons">
            <label class="btn btn-primary">
                <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.7777777777777777">
                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9">
                16:9
              </span>
            </label>
            <label class="btn btn-primary">
                <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1.3333333333333333">
                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3">
                4:3
              </span>
            </label>
            <label class="btn btn-primary">
                <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="1">
                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1">
                1:1
              </span>
            </label>
            <label class="btn btn-primary">
                <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="0.6666666666666666">
                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3">
                2:3
              </span>
            </label>
            <label class="btn btn-primary">
                <input type="radio" class="sr-only" id="aspectRatio5" name="aspectRatio" value="NaN">
                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN">
                Free
              </span>
            </label>
        </div>

    </div>

</div>

