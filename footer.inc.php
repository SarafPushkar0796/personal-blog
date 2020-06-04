<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(function(){
            $('.toggle').click(function(){
                $('.toggle').toggleClass('active');

                $('.card').toggle('z-index');
                $('.alert').toggle('z-index');
                
                $('.overlay').toggleClass('active');
                
                $('.menu').toggleClass('active');
            });

            $('.share').click(function(){
                if (navigator.share) {
                    navigator.share({
                        title: 'My awesome post!',
                        text: 'This post may or may not contain the answer to the universe',
                        url: window.location.href
                    }).then(() => {
                        alert('Thanks for sharing!');
                    })
                    .catch(err => {
                        alert(`Couldn't share because of`, err.message);
                    });
                } else {
                    alert('web share not supported');
                }
            });
        });
    </script>
</body>
</html>