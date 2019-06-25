
<div class="container gallery">

    <?php
    $photos = $data[0];
    $currUserId = $data[1];
    $comments = $data[2];

    foreach ($photos as $photo) {?>
        <div id="<?php echo $photo["path"]?>">

<!--            image-->
            <div>
                <img src="<?php echo $photo["path"]?>">
            </div>

<!--            buttons Like and Delete-->
            <div>

                <button id="<?php echo $photo["id"]?>" value="<?php echo $photo["likes"]?>" onclick="likePhoto(this.id)">
                    Like <?php echo $photo["likes"]?>
                </button>

                <?php if ($photo["user_id"] == $currUserId) : ?>
                <button value="<?php echo $photo["path"]?>" onclick="deleteImage(this.value)">
                    Delete
                </button>
                <?php endif; ?>

            </div>

<!--            comments-->
            <div>
<!--                previous comments-->
                <?php foreach ($comments as $comment) { ?>
                    <?php if ($comment["photo_id"] == ($photo["id"])): ?>

                        <article class="">
                            <header>
                                Commented by: <?php echo $comment["author"]?>
                            </header>
                            <section class="">
                                <p><?php echo($comment['comment']); ?></p>
                            </section>
                        </article>

                    <?php endif; ?>
                <?php } ?>

                <!--                make a new comment-->
                <form>
                    <textarea maxlength="100" placeholder="write a comment"></textarea>
                    <br>
                    <button onclick="sentComment()">
                        Submit
                    </button>
                </form>

            </div>

        </div>
        <?php
    }

    ?>

</div>

<script type="module" src="/js/comments.js"></script>
<script type="module" src="/js/actions_photo.js"></script>
<script type="module" src="/js/likes.js"></script>


