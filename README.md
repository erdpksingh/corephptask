# United Remote Backend Php Technical Test
The goal of this test is to evaluate your ability in enhancing existing code as well as debugging and fixing bugs.


## Instructions
Create a rest API  layer with the following main requirements
- API which allows users to add, edit, delete and retrieve customers
- A BusinessLogic layer where any business rules and logic will live
- A DataTransferObjects layer where any DTOs are stored
- A repository layer where entities are saved
- The result should be dockerised. 

Implement the code using php 8 or higher. 

## The following needs to be completed:
**1.	Implement the CRUD routes to manage customers**

Implement the crud to create, read, update and delete a customer. A customer will have the following fields, Name, Surname, Balance

**2.	Create a an accounts controller**

This will have the following routes:

```
GET /api/accounts/1
```

Returns account balance for customer 1

```
POST /api/accounts/1/deposit
{
   "funds" : 50
}
```

Deposits 50 Euro into the account of customer 1

```
POST /api/accounts/1/withdraw
{
   "funds" : 50
}
```

Withdraws 50 Euro from the account of customer 1

```
POST /api/accounts/transfer
{
   "from" : 1
   "to" : 2
   "funds" : 50
}
```

Transfers 50 Euro from the account of customer 1 to the account of customer 2.

Since balances are sensitive objects, we need to make sure that any operations done on them are thread safe. We also need to make sure that all operations done within one API call are all successful to maintain a proper state.

You are free to create any new classes / projects / methods /DTOs you deem best to implement the operations. 

**3.	Implement a proper read-model**

Implement a persistent read-model. Our suggested framework would be using an EventStore, however you are free to choose any other approach.

**4.	Audit any balance transactions occurring** 

We basically need to know of any transactions which are occurring on a customer's account.  It should be possible to re-build a customer's balance by going through the audits and re-applying all the transactions. Our suggested approach for this would be to use either EventStore or MariaDB.

**5.	Prevent customers from ending with a negative balance**

Add logic to prevent customers from ending with a negative balance

**6.	Implement unit tests**

Build a simple unit testing project which would cover code in both the Repository and BusinessLogic layers. Our suggested framework is xUnit, but you are free to use whatever you are most comfortable with.