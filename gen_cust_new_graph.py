
import pandas as pd
import matplotlib.pyplot as plt
import sys

# Read in the CSV file
df = pd.read_csv('generated_data.csv', encoding='latin-1')

# Get the username from command line arguments

username = sys.argv[1]


def generate_purchase_analysis(username):

    # Filter the data for the specified username
    user_data = df[df['UserName'] == username]

    # Line graph of purchase history
    fig, ax = plt.subplots(figsize=(16, 10))
    ax.plot(user_data['Date of Transaction'], user_data['Amount Paid'])
    ax.set_title('Purchase History')
    ax.set_xlabel('Date of Transaction')
    ax.set_ylabel('Amount Paid')
    ax.tick_params(axis='x', rotation=45)  # Rotate x-axis labels by 45 degrees
    plt.savefig(str(username) + '_purchase_history.png')

    # Pie chart of purchase categories
    category_counts = user_data['Product Name'].value_counts()
    plt.pie(category_counts, labels=category_counts.index)
    plt.title('Purchase Categories')
    plt.savefig(str(username) + 'purchase_categories.png')

    # Bar chart of purchase frequency
    monthly_counts = user_data['Date of Transaction'].str.split(
        '-', expand=True)[1].value_counts()
    plt.bar(monthly_counts.index, monthly_counts.values)
    plt.title('Monthly Purchase Frequency')
    plt.xlabel('Month')
    plt.ylabel('Number of Purchases')
    plt.savefig(str(username) + 'monthly_purchase_frequency.png')

    # Scatter plot of purchase amount vs. invoice number
    fig = plt.figure(figsize=(16, 8))
    plt.scatter(user_data['Amount Paid'], user_data['Invoice Number'])
    plt.title('Purchase Amount vs. Invoice Number')
    plt.xlabel('Amount Paid')
    plt.ylabel('Invoice Number')
    plt.savefig(str(username) + 'purchase_amount_vs_invoice_number.png',
                dpi=300, bbox_inches='tight')

    # Set the size of the figure
    fig = plt.figure(figsize=(16, 10))

    # Create the stacked area chart
    user_data_by_product = user_data.groupby(
        ['Product Name', 'Date of Transaction']).sum()['Amount Paid'].unstack()
    user_data_by_product.plot(kind='area', stacked=True)

    # Add axis labels and title
    plt.title('Purchase History by Product')
    plt.xlabel('Date of Transaction')
    plt.ylabel('Amount Paid')

    # Rotate the x-axis labels
    plt.xticks(rotation=45)

    # Save the figure with the desired dimensions
    plt.savefig(str(username) + 'purchase_history_by_product.png',
                dpi=300, bbox_inches='tight')


if len(sys.argv) != 2:
    print('Usage: generate_graphs.py <username>')
else:
    username = int(sys.argv[1])
    generate_purchase_analysis(username)
