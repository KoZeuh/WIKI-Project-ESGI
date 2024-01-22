<footer class="bg-body-tertiary text-center">
    <div class="container p-4 pb-0">
        <section class="mb-4">
            <a
                    data-mdb-ripple-init
                    class="btn text-white btn-floating m-1"
                    style="background-color: #3b5998;"
                    href="#!"
                    role="button"
            ><i class="fab fa-facebook-f"></i
                ></a>

            <a
                    data-mdb-ripple-init
                    class="btn text-white btn-floating m-1"
                    style="background-color: #55acee;"
                    href="#!"
                    role="button"
            ><i class="fab fa-twitter"></i
                ></a>

            <a
                    data-mdb-ripple-init
                    class="btn text-white btn-floating m-1"
                    style="background-color: #ac2bac;"
                    href="#!"
                    role="button"
            ><i class="fab fa-instagram"></i
                ></a>
        </section>
    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">© 2024 Copyright A.B, M.D, N.L - ESGI
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
<script src="https://cdn.tiny.cloud/1/cjx0ytvuzc3v0kps066x2s41lduakjfge45us4l8jm6aoyom/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#confirmLogoutBtn').on('click', function () {
            window.location.href = '/logout';
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('textarea#tiny').tinymce({
            height: 500,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });
    });
</script>
</html>