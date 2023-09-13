# projectPHP
projectPHP - work

- Diagrama de relacionamento


  <img src = "https://github.com/Natanssilva/projectPHP/assets/99294586/9c469bf7-f9d4-4b0d-91e8-e252d99057b2"> 

- Os relacionamentos do tipo N:N (muitos para muitos) ocorrem quando vários registros de uma tabela se relacionam a vários registros de outra. Ou seja, em nenhum dos lados há exclusividade no relacionamento.
  Diferente do que ocorre no 1:N, nessas situações não é possível que uma tabela tenha uma referência direta à outra, pois isso indicaria que cada registro está relacionado unicamente a um da outra tabela.
  Surge nesse caso uma tabela intermediária que relaciona as outras duas, como o db acima. Essa tabela intermediaria tem duas chaves estrangeiras que apontam pra chaves primarias das outras duas tabelas principais.

- Criando projeto por etapas:
    - ETAPA 1: Varrer a tabela de pedidos(buscar nome de cliente através do relacionameto com a tabela de cliente)
        - Consulta para buscar nome do cliente através do relacionamento com a tabela de cliente. Pra isso foi feito o seguinte código SQL:
          ```
          SELECT p.num_pedido, c.nom_cliente
          FROM pedido AS p
          LEFT JOIN cliente AS c ON (p.cod_cliente = c.cod_cliente);
          ```
          - AS p, AS c são formas de colocar apelidos a tabelas e tornar mais facil
          - O código SQL resultou na seguinte consulta:
               <br>
               <img src  = "https://github.com/Natanssilva/projectPHP/assets/99294586/63ffca80-a25d-47f0-aa29-495851b0ea14">
               <br>
    - ETAPA 2: Para cada pedido, varrer a tabela de itens e apresentar abaixo do pedido (buscar denominação do item através de relacionamento com a tabela de item).
      -  Consulta para buscar denominação do item através de relacionamento com a tabela de item. Pra isso foi feito o seguinte código SQL:
        ```
            SELECT p.num_pedido,i.num_seq_item, i.cod_item,it.den_item
            FROM pedido AS p 
            JOIN item_pedido AS i ON (p.num_pedido = i.num_pedido)
            JOIN item AS it ON  (i.cod_item = it.cod_item);
        ```
         <br>
               <img src  = "https://github.com/Natanssilva/projectPHP/assets/99294586/d83c73f2-e606-4cf3-b495-8d9826a3c2df">
         <br>
  - ADICIONANDO DADOS:
    ```
      INSERT item_pedido (num_pedido, num_seq_item, cod_item,qtd_solicitada, pre_unitario)
      VALUES (99,6,1,1,9.90);

      INSERT item_pedido (num_pedido, num_seq_item, cod_item,qtd_solicitada, pre_unitario)
      VALUES (100,7,2,1,10.90);


      INSERT pedido (num_pedido,cod_cliente)
      VALUES (99,1);


      INSERT pedido (num_pedido,cod_cliente)
      VALUES (100,2);
    ```
