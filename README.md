# projectPHP
projectPHP - work

- Diagrama de relacionamento


  <img src = "https://github.com/Natanssilva/projectPHP/assets/99294586/9c469bf7-f9d4-4b0d-91e8-e252d99057b2"> 

- Os relacionamentos do tipo N:N (muitos para muitos) ocorrem quando vários registros de uma tabela se relacionam a vários registros de outra. Ou seja, em nenhum dos lados há exclusividade no relacionamento.
  Diferente do que ocorre no 1:N, nessas situações não é possível que uma tabela tenha uma referência direta à outra, pois isso indicaria que cada registro está relacionado unicamente a um da outra tabela.
  Surge nesse caso uma tabela intermediária que relaciona as outras duas, como o db acima. Essa tabela intermediaria tem duas chaves estrangeiras que apontam pra chaves primarias das outras duas tabelas principais.

- Criando projeto por etapas:
    - ETAPA 1: Varrer a tabela de pedidos(buscar nome de cliente através do relacionameto com a tabela de cliente)
        - Pra isso foi feito o seguinte código SQL:
          ```
          explica SELECT p.num_pedido, c.nom_cliente
          FROM pedido AS p
          LEFT JOIN cliente AS c ON (p.cod_cliente = c.cod_cliente);
          ```
          - AS p, AS c são formas de colocar apelidos a tabelas e tornar mais facil
          - O código SQL resultou na seguinte consulta:
               <img src  = "">
