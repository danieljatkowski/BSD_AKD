<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h1>RailFence</h1><br />
                <form method="POST" action="railFence_end.php">
                    <b>Do zakodowania: </b>
                    <input type="text" class="form-control" name="encode"><br />
                    <b>Ilość linii: </b>
                    <input type="text" class="form-control" name="encode_rail"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
                    <form method="POST" action="railFence_end.php">
                    <b>Do odkodowania: </b>
                    <input type="text" class="form-control" name="decode"><br />
                    <b>Ilość linii: </b>
                    <input type="text" class="form-control" name="decode_rail"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
            </div>
            <div class="col-lg-4">
                <h1>Cezar</h1><br />
                <form method="POST" action="cesar.php">
                    <b>Do zakodowania: </b>
                    <input type="text" class="form-control" name="encode_text"><br />
                    <b>Przesunięcie: </b>
                    <input type="text" class="form-control" name="encode_offset"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
                    <form method="POST" action="cesar.php">
                    <b>Do odkodowania: </b>
                    <input type="text" class="form-control" name="decode_text"><br />
                    <b>Przesunięcie: </b>
                    <input type="text" class="form-control" name="decode_offset"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
            </div>
            <div class="col-lg-4">
                <h1>Vigenere</h1><br />
                <form method="POST" action="vigenere.php">
                    <b>Do zakodowania: </b>
                    <input type="text" class="form-control" name="encode_text"><br />
                    <b>Hasło: </b>
                    <input type="text" class="form-control" name="encode_password"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
                    <form method="POST" action="vigenere.php">
                    <b>Do odkodowania: </b>
                    <input type="text" class="form-control" name="decode_text"><br />
                    <b>Hasło: </b>
                    <input type="text" class="form-control" name="decode_password"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
            </div>
        </div>
    </div>
    
</body>