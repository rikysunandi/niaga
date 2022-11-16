
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed by <a href="https://www.pln.co.id">PLN UID Jabar</a> 2020</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>

        <script type="text/javascript">
            
            function doLogout(){

                console.log('logout...');
                $('div.content-body').block({ message: 'Keluar dari aplikasi...' });
                $.getJSON('../controller/logout.php', function(data){
                    $('div.content-body').unblock();
                    if(data.success){ window.location.href="login.php"; }

                });

            }

            $('.basicAutoComplete').autoComplete({
                resolverSettings: {
                    url: '../controller/getParam.php'
                },
                minLength:3
            });

            $('.basicAutoComplete').on('autocomplete.select', function(evt, item) {
                //alert($(this).val());
                console.log(item.value);
                $.post( "../controller/setSession.php", { key: "param_idpel", value: item.value }, function(data){
                    console.log(data);
                    if(data.success)
                        window.location.href='info_pelanggan.php';
                } );
            });

        </script>