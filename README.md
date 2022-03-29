# employees [Employee]
<!-- 
id
name
email
phone
address
salary
photo
nid
joinging_date 
-->

# suppliers [Supplier]
<!--
id
name
email
phone
address
photo
shop_name 
-->

# categories [Category]
<!-- 
id
name 
-->

# products [Product]
<!-- 
id
name
code
root
buying_date
quantity
image
buying_price
selling_price
category_id
supplier_id 
-->

# expenses [Expense]
<!-- 
id
details
amount
date
name 
-->

# customers [Customer]
<!-- 
id
name
email
phone
address
photo 
-->

# slaries [Slary]
<!-- 
id
amount
date
month
year
demployee_id 
-->

# orders [Order]
<!-- 
id
qty
sub_total
vat
total
pay
due
pay_by
order_date
month
year
customer_id 
-->

# order_details [OrderDetail]
<!-- 
id
quantity
price
sub_total
product_id
order_id 
-->

<!-- #  |--------------------------------------------------------------------------|
#  |TABLES                   #TABLES                             #TABLES      |
#  |--------------------------------------------------------------------------|
#  |users	    hasOne	    profile	            belongsTo	    users         |
#  |employees	hasMany	    slaries	            belongsTo	    employees     |
#  |suppliers	hasMany	    products	        belongsTo	    suppliers     |
#  |categories	hasMany	    products	        belongsTo	    categories    |
#  |products	hasMany	    order_details	    belongsTo	    products      |
#  |customers	hasMany	    orders	            belongsTo	    customers     |
#  |orders	    hasMany	    order_details	    belongsTo	    orders        |
#  |--------------------------------------------------------------------------| -->


<!-- Home
Employee
Supplier
Category
Product
Expense
Customer
Slarie
Order
OrderDetail
Setting -->