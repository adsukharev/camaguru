
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
            <button type="submit" onclick="uploadPhoto();return false;" value="ok" name="upload">Use your photo</button>
        </form>
        <br>

        <h4>Filters</h4>
        <form id="filters">
            <input type="radio" id="cat" name="mem" value="cat" checked>
            <label for="cat"> Cat </label>
            <br>
            <input type="radio" id="life" name="mem" value="life">
            <label for="life">Thug Life </label>
            <br>
            <input type="radio" id="vietnam" name="mem" value="vietnam">
            <label for="vietnam">Vietnam's flashbacks</label>
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

<script type="module" src="/js/webcam.js?v=1"></script>
<script type="module" src="/js/actions_photo.js?v=1"></script>

