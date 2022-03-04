# openvpngui
Interface web para interação com o cliente openvpn3 disponível no Linux

## instalação
1) Instale o cliente openvpn3 [aqui](https://openvpn.net/cloud-docs/openvpn-3-client-for-linux/).
2) Instale o PHP com ```sudo apt update && sudo apt install php```.
3) Clone ou baixe este repositório para o diretório ```/var/www/html/``` no seu Linux. A pasta ```openvpngui``` deverá ficar dentro de ```/var/www/html/```. CASO VOCÊ BAIXE O REPOSITÓRIO DIRETAMENTE, PRECISARÁ RENOMEAR A PASTA PARA O NOME CORRETO!
5) Crie a pasta ```files``` dentro de ```/var/www/html/openvpngui/```
6) Abra o arquivo do serviço com ```sudo nano /etc/systemd/system/openvpngui.service``` e copie o conteúdo abaixo para dentro dele. Salve-o em seguida.
```
[Unit]
Description=OpenVPN GUI Linux - Wallace Andrade © 2022. Please see https://github.com/wallacemariadeandrade/openvpngui

[Service]
WorkingDirectory=/var/www/html/openvpngui
ExecStart=/usr/bin/php -S localhost:8080
Restart=always
RestartSec=10
SyslogIdentifier=openvpngui
User=root

[Install]
WantedBy=multi-user.target
```
7) Habilite o serviço com ```sudo systemctl enable openvpngui.service```.
8) Inicie o serviço com ```sudo systemctl start openvpngui.service```.
9) Confirme se o serviço foi inicializado corretamente com ```sudo systemctl status openvpngui.service```. Você deverá ver algo similiar ao output abaixo.
```
● openvpngui.service - OpenVPN GUI Linux - Wallace Andrade © 2022
     Loaded: loaded (/etc/systemd/system/openvpngui.service; enabled; vendor preset: enabled)
     Active: active (running) since Tue 2022-03-01 06:43:52 -03; 9min ago
   Main PID: 10366 (php)
      Tasks: 1 (limit: 38217)
     Memory: 6.1M
     CGroup: /system.slice/openvpngui.service
             └─10366 /usr/bin/php -S localhost:8080

mar 01 06:44:31 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:44:31 2022] 127.0.0.1:52428 Closing
mar 01 06:44:31 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:44:31 2022] 127.0.0.1:52430 Accepted
mar 01 06:44:31 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:44:31 2022] 127.0.0.1:52430 [200]: GET /style.css
mar 01 06:44:31 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:44:31 2022] 127.0.0.1:52430 Closing
mar 01 06:45:11 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:45:11 2022] 127.0.0.1:52432 Accepted
mar 01 06:45:11 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:45:11 2022] 127.0.0.1:52432 [200]: GET /openvpngui.php
mar 01 06:45:11 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:45:11 2022] 127.0.0.1:52432 Closing
mar 01 06:45:11 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:45:11 2022] 127.0.0.1:52434 Accepted
mar 01 06:45:11 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:45:11 2022] 127.0.0.1:52434 [200]: GET /style.css
mar 01 06:45:11 jarvisk2 openvpngui[10366]: [Tue Mar  1 06:45:11 2022] 127.0.0.1:52434 Closing
```
10) Se tudo deu certo até aqui, você já poderá acessar a interface web na url ```localhost:8080/openvpngui.php```.

## utilização

1) Importe os arquivos necessários à conexão para dentro da aplicação via botão de import. Geralmente são necessários os arquivos de certificado do usuário e servidor (.crt), chaves privadas do usuário (.key) e o profile OpenVPN (.ovpn).
2) Edite o arquivo .ovpn ajustando a diretiva dos arquivos .crt e .key para ```/var/www/html/openvpngui/files/[arquivo]```. Exemplo:
```
...

ca /var/www/html/openvpngui/files/ca.crt
cert /var/www/html/openvpngui/files/wallace.crt
key /var/www/html/openvpngui/files/wallace.key
ta /var/www/html/openvpngui/files/ta.key
...

```
3) Escolha o profile desejado e clique em "Conectar". Uma nova página será aberta mostrando o output do cliente openvpn3, o qual também passará a ser mostrado na home page.
4) Para desconectar, copie o path da sessão desejada, cole no campo "Session path" e clique em "Desconectar". Uma nova página irá mostrar as estatísticas da sessão encerrada.

### rota IPv6
Aparentemente existe um problema com a entrega da rota default IPv6 através da VPN quando em sistemas Linux. Para contornar isso a ferramenta ofereçe a opção de atribuição manual, bastando inserir o nome da interface túnel criada pela VPN e clicando em "Aplicar". Uma rota para 2000::/3 será inserida apontando para a interface túnel informada.

- Obs1: se sua OpenVPN não lhe entrega IPv6, ignore essa funcionalidade!
- Obs2: só use se você estiver passando pelo problema mencionado, caso contrário poderá gerar problemas de conectivdade.
- Obs3: ao desconectar a OpenVPN a rota IPv6 é removida automaticamente!
