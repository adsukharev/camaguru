<?php
if (!$data['photos']){
    echo "No photos yet";
    die();
}
$photos = $data["photos"];
$currUserId = $data["currUserId"];
$comments = $data["comments"];
$pages = $data["pages"];
$logged = '';
$disabled = '';
if (isset($_SESSION['loggued_on_user'])){
    $logged = $_SESSION['loggued_on_user'];
}
if (!$logged){
    $disabled = 'disabled';
}
?>

<div class="container gallery">

    <?php
    foreach ($photos as $photo) {
        ?>
        <div class="borderGallery" id="<?php echo $photo["path"]?>">

            <!--            image-->
            <div>
                <img src="<?php echo $photo["path"]?>">
            </div>

            <!--            buttons Like and Delete-->
            <div>

                <button id="<?php echo $photo["id"]?>" value="<?php echo $photo["likes"]?>" <?php echo $disabled ?>  onclick="likePhoto(this.id);return false;">
                    Like <?php echo $photo["likes"]?>
                </button>

                <?php if ($photo["user_id"] == $currUserId) : ?>
                    <button value="<?php echo $photo["path"]?>" onclick="deleteImage(this.value);return false;">
                        Delete
                    </button>
                <?php endif; ?>

            </div>

            <!--            comments-->
            <div>
                <?php $textId = "textarea-".$photo['id'];?>

                <textarea id="<?php echo($textId);?>" maxlength="100" placeholder="write a comment"></textarea>
                <br>
                <button value="<?php echo($textId);?>" onclick="sendComment(this.value);return false;" <?php echo $disabled ?>>
                    Comment
                </button>

                <!--                previous comments-->
                <?php foreach ($comments as $comment) { ?>
                    <?php if ($comment["photo_id"] == ($photo["id"])): ?>

                        <article class="">
                            <p><?php echo $comment["author"] . ": " . ($comment['comment']); ?></p>
                        </article>

                    <?php endif; ?>
                <?php } ?>

                <!--                make a new comment-->

            </div>

        </div>

    <?php } ?>

</div>

<ul class="inline">
    <?php for ($i = 1; $i <= $pages; $i++){
        ?>
        <li> <a href="/gallery?page=<?php echo $i; ?>"> <?php echo $i; ?></a></li>
        <?php
    }
    ?>
</ul>

<script type="module" src="/js/comments.js?v=1"></script>
<script type="module" src="/js/actions_photo.js?v=1"></script>
<script type="module" src="/js/likes.js?v=1"></script>