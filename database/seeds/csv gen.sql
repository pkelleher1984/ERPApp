USE Orders;




#books.csv
SELECT * FROM book left join SKU on book.SKUid=SKU.id;

#SKUall.csv
SELECT * FROM SKU left join book on book.SKUid=SKU.id;

#SKU.csv
SELECT SKU.code as skuid, book.desc as name, book.printStack as printstack, book.imps as imps FROM SKU left join book on book.SKUid=SKU.id where printStack IS NOT NULL;


#orderall.csv
SELECT * FROM Orders.order left join SKU on Orders.order.SKUid=SKU.id;


#Order.csv
SELECT 
SKU.code as skuid,
order.Descr as descr,
order.dateDue as datedue, 
order.dateOrdered as dateordered, 
order.qtyPrinted as qtyprinted,
order.qtyOrdered as qtyordered,
order.priority as priority,   
order.notes as notes,
book.imps as imps,
book.printStack as printstack
FROM Orders.order 
left join SKU on Orders.order.SKUid=SKU.id
left join book on Orders.order.SKUid=book.SKUid;