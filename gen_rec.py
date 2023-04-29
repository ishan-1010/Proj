import random
import pandas as pd
from sklearn.neighbors import NearestNeighbors
import numpy as np
from sklearn.metrics.pairwise import cosine_similarity
import sys

# Replace with the actual path to the products.csv file
products_df = pd.read_csv(
    r"https://raw.githubusercontent.com/ishan-1010/Project_EvenSem/main/products.csv")
# Replace with the actual path to the order_products__prior.csv file
orders_df = pd.read_csv(
    r"https://raw.githubusercontent.com/ishan-1010/Project_EvenSem/main/order_products__prior.csv", nrows=50000)


def get_recommendations(user):
    # Get the products ordered by the selected user
    user_orders = orders_df.loc[orders_df['order_id'] == user]
    user_products = user_orders['product_id'].tolist()

    # Randomly select a subset of the user's orders to calculate cosine similarity
    num_user_orders = len(user_orders)
    sample_size = min(num_user_orders, 5)  # Choose up to 5 orders
    sample_indices = random.sample(range(num_user_orders), sample_size)
    sample_orders = user_orders.iloc[sample_indices]

    # Calculate cosine similarity between the sampled orders and all other orders
    orders_matrix = pd.pivot_table(orders_df, values='reordered',
                                   index='order_id', columns='product_id', aggfunc=np.sum, fill_value=0)
    cosine_sim = cosine_similarity(
        orders_matrix.loc[sample_orders['order_id']])

    # Find the k-nearest neighbors of the selected user
    k = 5  # Number of neighbors to consider
    knn = NearestNeighbors(n_neighbors=k, metric='cosine')
    knn.fit(cosine_sim)
    user_index = orders_df[orders_df['order_id'] == user].index[0]
    neighbors = knn.kneighbors(
        cosine_sim[user_index].reshape(1, -1), return_distance=False)

    # Get product recommendations from the top k neighbors
    recommended_orders = orders_df.loc[neighbors[0], 'order_id']
    recommended_product_ids = orders_df.loc[orders_df['order_id'].isin(
        recommended_orders), 'product_id'].value_counts().index.tolist()

    # Get product names from product IDs
    recommended_product_names = products_df.loc[products_df['product_id'].isin(
        recommended_product_ids), 'product_name']

    # If less than 5 recommendations are found, randomly sample from all product names
    if len(recommended_product_names) < 5:
        all_product_names = products_df['product_name']
        recommended_product_names = recommended_product_names.append(
            all_product_names.sample(5 - len(recommended_product_names)))

    # Limit the number of recommendations to 5
    recommended_product_names = recommended_product_names[:5]

    # Store recommendations in a file for the current user
    username = f"user{user}"
    with open(f"{username}_recommendationsNEW.txt", "w") as file:
        for product in recommended_product_names:
            file.write(product + "\n")


username = 1
get_recommendations(username)
