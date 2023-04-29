import pandas as pd
import matplotlib.pyplot as plt
import plotly.express as px

# Load data from CSV file
df = pd.read_csv('generated_data.csv', encoding='latin-1')


# set the value of n to control the number of labels to show
n = 30
# group by the product name and calculate the total sales
sales_by_product = df.groupby('Product Name')[
    'Amount Paid'].sum().sort_values(ascending=False)
# plot the total sales by product
sales_by_product.plot(kind='bar', figsize=(12, 32))
plt.title('Total Sales by Product')
plt.xlabel('Product Name')
plt.ylabel('Total Sales')
# show only every nth label
plt.xticks(range(0, len(sales_by_product.index), n),
           sales_by_product.index[::n], rotation=90)

plt.savefig('sales_by_product.png')


# 2. Sales by Month/Year
sales_by_date = df.groupby(df['Date of Transaction'].dt.to_period('M'))[
    'Amount Paid'].sum()
sales_by_date.plot(kind='line', figsize=(10, 6))
plt.title('Sales by Month/Year')
plt.xlabel('Month/Year')
plt.ylabel('Total Sales')
plt.savefig('sales_by_date.png')


# set the value of n to control the number of labels to show
n = 3
# group by the user name and calculate the total sales
sales_by_user = df.groupby('UserName')[
    'Amount Paid'].sum()
# plot the total sales by user
sales_by_user.plot(kind='bar', figsize=(10, 6))
plt.title('Sales by User')
plt.xlabel('User Name')
plt.ylabel('Total Sales')
# show only every nth label
plt.xticks(range(0, len(sales_by_user.index), n),
           sales_by_user.index[::n], rotation=45)
plt.savefig('sales_by_user.png')


# get the top 10 selling products
top_selling = df['Product Name'].value_counts().sort_values(ascending=False)[
    :10]
# plot the top-selling products
top_selling.plot(kind='bar', figsize=(24, 16))
plt.title('Top-selling Products')
plt.xlabel('Product Name')
plt.ylabel('Number of Sales')
# rotate the x-axis labels by 45 degrees
plt.xticks(rotation=25, ha='right')
plt.savefig('top_selling.png')
