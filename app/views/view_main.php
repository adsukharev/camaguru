
<div class="container main">

<!--    left-->
    <div class="borderBlue">

        <h3>Control Panel</h3>
        <h4>WebCamera</h4>
        <button id="startVideo" onclick="startVideo()">Start webcamera</button>
        <br>
        <button onclick="takeScreenshot()" id="screenshot-button" >Take a screenshot</button>
        <br>

        <h4>Upload Photo</h4>
        <form id="upload" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="photo">
<!--            <input type="submit" name="aa">-->
            <button type="submit" onclick="sendPhoto();return false;" value="ok" name="upload">Use your photo</button>
        </form>
        <br>

        <h4>Filters</h4>
        <form id="filters">
            <input type="checkbox" id="cat" name="cat">
            <label for="cat">Space Cat </label>
            <br>
            <input type="checkbox" id="dog" name="dog">
            <label for="dog">Watermelon Dog </label>
            <br>
            <input type="checkbox" id="bob" name="bob">
            <label for="bob">Angry Bob</label>
        </form>
    </div>

<!--    center-->
    <div>
        <h3>WebCamera</h3>
        <video autoplay></video>
    </div>

<!--    right-->
    <div class="borderBlue">
        <h3>Your Photos</h3>
        <div id="screens">

        </div>
    </div>

</div>

<script src="/js/webcam.js"></script>
<script src="/js/actions_photo.js"></script>

