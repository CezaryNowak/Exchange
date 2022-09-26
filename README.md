1. Wartości do połączenia z bazą danych są w pliku .env
2. Ustawione są wartości seed więc należy użyć komendy "php artisan migrate:refresh --seed" w celu 
    stworzenia i zapełnienia bazy danych.
3. By pojawiały się avatary należy użyć komendy "php artisan storage:link"