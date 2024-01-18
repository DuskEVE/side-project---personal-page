

<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <!-- <h1 class="modal-title fs-5" id="login-modal-label">Modal title</h1> -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                <img class="gallery-view" src="">
            </div>
            <div class="d-flex justify-content-between mt-2 mb-2">
                <div class="gallery-title"></div>
                <?php if(isset($_SESSION['user'])){?>
                <div class='gallery-like d-flex justify-content-center align-items-center' style="height: 50px;">
                    <div class="btn btn-secondary gallery-like-btn d-flex justify-content-center align-items-center" 
                     data-user='<?=$_SESSION['user']?>'>
                        <i class='fa-regular fa-heart' style="pointer-events: none;"></i>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="mt-2 mb-2">
                <span class="gallert-text"></span>
            </div>
        </div>
    </div>
</div>
