<body>
    <h1>RailFence</h1><br />
    <form method="POST" action="railFence_end.php">
        <b>Do zakodowania: </b>
        <input type="text" name="encode"><br />
        <b>Ilość linii: </b>
        <input type="text" name="encode_rail"><br />
        <input type="submit" value="Wyślij">
    </form>
        <form method="POST" action="railFence_end.php">
        <b>Do odkodowania: </b>
        <input type="text" name="decode"><br />
        <b>Ilość linii: </b>
        <input type="text" name="decode_rail"><br />
        <input type="submit" value="Wyślij">
    </form>
    <h1>Cezar</h1><br />
    <form method="POST" action="cesar.php">
        <b>Do zakodowania: </b>
        <input type="text" name="encode_text"><br />
        <b>Przesunięcie: </b>
        <input type="text" name="encode_offset"><br />
        <input type="submit" value="Wyślij">
    </form>
        <form method="POST" action="cesar.php">
        <b>Do odkodowania: </b>
        <input type="text" name="decode_text"><br />
        <b>Przesunięcie: </b>
        <input type="text" name="decode_offset"><br />
        <input type="submit" value="Wyślij">
    </form>
    <h1>Vigenere</h1><br />
    <form method="POST" action="vigenere.php">
        <b>Do zakodowania: </b>
        <input type="text" name="encode_text"><br />
        <b>Hasło: </b>
        <input type="text" name="encode_password"><br />
        <input type="submit" value="Wyślij">
    </form>
        <form method="POST" action="vigenere.php">
        <b>Do odkodowania: </b>
        <input type="text" name="decode_text"><br />
        <b>Hasło: </b>
        <input type="text" name="decode_password"><br />
        <input type="submit" value="Wyślij">
    </form>
</body>