<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <center>
        <h1> PS 2</h1>  </br>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
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
            <div class="col-lg-3">
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
            <div class="col-lg-3">
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
            <div class="col-lg-3">
                <h1>Macierze</h1><br />
                <form method="POST" action="transposition.php">
                    <b>Do zakodowania: </b>
                    <input type="text" class="form-control" name="encode"><br />
                    <b>Szyfr: </b>
                    <input type="text" class="form-control" name="encode_cipher"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
                <form method="POST" action="transposition.php">
                    <b>Do odkodowania: </b>
                    <input type="text" class="form-control" name="decode"><br />
                    <b>Szyfr: </b>
                    <input type="text" class="form-control" name="decode_cipher"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
            </div>
        </div>
        <hr />
    </div>
    <center>
        <h1> PS 3</h1>  </br>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <h1>Generator</h1><br />
                <form method="GET" action="generator.php">
                    <center>
                        <input type="submit" class="btn btn-primary" value="Uruchom">
                    </center>
                </form>
            </div>
        </div>
    </div>
</body>