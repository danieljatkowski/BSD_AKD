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
            <div class="col-lg-3">
                <h1>Generator</h1><br />
                <form method="POST" action="generator-daniel.php">
                    <b>Ciąg binarny: </b>
                    <input type="text" class="form-control" name="input"><br />
                    <b>O ile pozycji do XOR: </b>
                    <input type="text" class="form-control" name="number"><br />
                    <b>Do zakodowania: </b>
                    <input type="text" class="form-control" name="to_encrypt"><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
            </div>
        </div>
    </div>
    <center>
        <h1> PS 4</h1>  </br>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h1>Szyfrowanie DES</h1><br />
                <form method="POST" action="DES.php" enctype="multipart/form-data">
                    <b>Wpisz tekst do zaszyfrowania: </b>
                    <input type="text" class="form-control" name="tekst"><br />
                    <b>Wrzuć plik .txt z kluczem</b><br />
                    <input type="file" class="form-control-file" name="txt" /><br /><br />
                    <input type="submit" class="btn btn-primary" value="Wyślij">
                </form>
            </div>
        </div>
    </div>
</body>