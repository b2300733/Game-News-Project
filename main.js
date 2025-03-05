document.querySelectorAll('.login__form, .signup__form, .forgot__form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const action = this.getAttribute('action');

        fetch(action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var userEmail = localStorage.getItem('userEmail');
 
    if (userEmail) {
        document.getElementById('user-email').textContent = userEmail;
        document.getElementById('logout-form').style.display = 'block'; // Show logout button
        document.getElementById('login-btn').style.display = 'none'; // Hide login button
    } else {
        document.getElementById('user-email').textContent = '';
        document.getElementById('logout-form').style.display = 'none'; // Hide logout button
        document.getElementById('login-btn').style.display = 'block'; // Show login button
    }
 });
 
 document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
 
    var email = document.getElementById('login-email').value;
    var password = document.getElementById('login-password').value;
 
    if (email && password) {
       localStorage.setItem('userEmail', email);
       localStorage.setItem('loginTime', Date.now()); // Save the current timestamp
 
       document.getElementById('user-email').textContent = email;
       document.getElementById('logout-form').style.display = 'block';
       document.getElementById('login-btn').style.display = 'none';
       document.getElementById('login').style.display = 'none';
    } else {
        alert('Please enter a valid email and password.');
    }
 });

 document.getElementById('login-form').addEventListener('submit', async function(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    const response = await fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const result = await response.json();
    const messageElem = document.getElementById('login-message');

    if (result.success) {
        messageElem.textContent = '';
        window.location.href = result.redirect;
    } else {
        messageElem.textContent = result.message;
    }
});
 
document.getElementById('logout-btn').addEventListener('click', function() {
    localStorage.removeItem('userEmail');
    localStorage.removeItem('loginTime'); // Clear the login time as well

    document.getElementById('user-email').textContent = '';
    document.getElementById('logout-form').style.display = 'none';
    document.getElementById('login-btn').style.display = 'block';
});

 
 document.addEventListener('DOMContentLoaded', function() {
    var userEmail = localStorage.getItem('userEmail');
    var loginTime = localStorage.getItem('loginTime');
    var thirtyDays = 30 * 24 * 60 * 60 * 1000; // 30 days in milliseconds

    if (userEmail && loginTime) {
        if (Date.now() - loginTime > thirtyDays) {
            // If more than 30 days have passed, log the user out
            localStorage.removeItem('userEmail');
            localStorage.removeItem('loginTime');
            alert('Your session has expired. Please log in again.');
            // Optionally, you could also refresh the page to update the UI
            location.reload();
        } else {
            document.getElementById('user-email').textContent = userEmail;
            document.getElementById('logout-form').style.display = 'block'; // Show logout button
            document.getElementById('login-btn').style.display = 'none'; // Hide login button
        }
    } else {
        document.getElementById('user-email').textContent = '';
        document.getElementById('logout-form').style.display = 'none'; // Hide logout button
        document.getElementById('login-btn').style.display = 'block'; // Show login button
    }
});


/***********************************//***********************************//***********************************//***********************************/

const search = document.getElementById('search'),
      searchBtn = document.getElementById('search-btn'),
      searchClose = document.getElementById('search-close')

/* Search show */
searchBtn.addEventListener('click', () =>{
   login.classList.remove('show-login')
   signup.classList.remove('show-signup')
   forgot.classList.remove('show-forgot')
   search.classList.add('show-search')
})

/* Search hidden */
searchClose.addEventListener('click', () =>{
   search.classList.remove('show-search')
})


const login = document.getElementById('login'),
      loginBtn = document.getElementById('login-btn'),
      loginClose = document.getElementById('login-close'),
      SignupToLogin = document.getElementById('signup__login')

/* Login show */
loginBtn.addEventListener('click', () =>{
   search.classList.remove('show-search')
   signup.classList.remove('show-signup')
   forgot.classList.remove('show-forgot')
   login.classList.add('show-login')
})

/* Login show from Signup */
SignupToLogin.addEventListener('click', () =>{
   signup.classList.remove('show-signup')
   login.classList.add('show-login')
})

/* Login hidden */
loginClose.addEventListener('click', () =>{
   login.classList.remove('show-login')
})

const signup = document.getElementById('signup'),
      signupBtn = document.getElementById('login__signup'),
      signupClose = document.getElementById('signup-close')

/* Signup show */
signupBtn.addEventListener('click', () =>{
   login.classList.remove('show-login')
   signup.classList.add('show-signup')
})

/* Signup hidden */
signupClose.addEventListener('click', () =>{
   signup.classList.remove('show-signup')
})

const forgot = document.getElementById('forgot'),
      forgotBtn = document.getElementById('login__forgot'),
      forgotClose = document.getElementById('forgot-close')

/* Forgot show */
forgotBtn.addEventListener('click', () =>{
   login.classList.remove('show-login')
   forgot.classList.add('show-forgot')
})

/* forgot hidden */
forgotClose.addEventListener('click', () =>{
   forgot.classList.remove('show-forgot')
})


/***********************************//***********************************//***********************************//***********************************/

document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search__form');
    const searchInput = document.getElementById('search-input');
    const resultsContainer = document.getElementById('resultsContainer');

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const query = searchInput.value.trim();
        if (query) {
            searchGames(query);
        } else {
            resultsContainer.innerHTML = '<p>Please enter a search term.</p>';
        }
    });

    function searchGames(query) {
        fetch(`library.php?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error from server:', data.error);
                    resultsContainer.innerHTML = `<p>${data.error}</p>`;
                } else {
                    displayResults(data);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                resultsContainer.innerHTML = '<p>An error occurred while searching. Please try again later.</p>';
            });
    }

    function displayResults(data) {
        resultsContainer.innerHTML = '';
        if (data.results && data.results.length > 0) {
            data.results.forEach(game => {
                const gameElement = document.createElement('div');
                gameElement.classList.add('game');
                gameElement.innerHTML = `
                    <a href="https://rawg.io/games/${game.id}" target="_blank">
                         <img src="${game.background_image}" alt="${game.name} thumbnail">
                        <div class="game-info">
                            <h2 class="game-title">${game.name}</h2>
                            <p class="gamesearch-rating">${game.rating ? `Rating: ${game.rating}` : 'No rating available'}</p>
                            <p class="gamesearch-rating">${game.reviews_count ? `(${game.reviews_count} reviews)` : 'No reviews available'}</p>
                        </div>
                    </a>
                `;

                resultsContainer.appendChild(gameElement);
            });
        } else {
            resultsContainer.innerHTML = '<p>No results found.</p>';
        }
    }
});


/***********************************//***********************************//***********************************//***********************************/

document.addEventListener('DOMContentLoaded', function () {
    const apiKey = '99973af7a6cb44f1a606bbb5193f27c5';
    let orderBy = 'popularity'; // Default ordering by popularity
    let currentPage = 1; // Track current page of results
    let searchQuery = ''; // Track search query

    const orderSelect = document.getElementById('order-select');
    const showMoreButton = document.getElementById('show-more-btn');
    const searchInput = document.getElementById('search-input');

    orderSelect.value = orderBy; // Set default value in select element

    orderSelect.addEventListener('change', function () {
        orderBy = orderSelect.value;
        currentPage = 1; // Reset to first page
        fetchGames(true); // Indicate to clear the game list
    });

    showMoreButton.addEventListener('click', function () {
        currentPage++;
        fetchGames();
    });

    function fetchGames(clearList = false) {
        const pageSize = 16; // Number of games per page
        const apiUrl = `https://api.rawg.io/api/games?key=${apiKey}&ordering=-${orderBy}&page_size=${pageSize}&page=${currentPage}`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const games = data.results;
                const gameListElement = document.getElementById('game-list');

                if (clearList) {
                    gameListElement.innerHTML = ''; // Clear previous games if needed
                }

                games.forEach(game => {
                    const gameElement = document.createElement('div');
                    gameElement.classList.add('game');

                    const imageUrl = game.background_image;
                    const name = game.name;
                    const rating = game.rating;
                    const reviewsCount = game.reviews_count;
                    const gameId = game.id;
                    const gameUrl = `https://rawg.io/games/${gameId}`;

                    gameElement.innerHTML = `
                        <a href="${gameUrl}" target="_blank">
                            <img src="${imageUrl}" alt="${name} thumbnail">
                            <div class="game-info">
                                <h2 class="game-title">${name}</h2>
                                <div class="game-rating">Rating: ${rating} (${reviewsCount} reviews)</div>
                            </div>
                        </a>
                    `;

                    gameListElement.appendChild(gameElement);
                });

                // Hide the "Show More" button if no more pages are available
                if (data.next === null) {
                    showMoreButton.style.display = 'none';
                } else {
                    showMoreButton.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Initial fetch with default ordering
    fetchGames();
});

document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const resultsContainer = document.getElementById('resultsContainer');

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const query = searchInput.value;
        searchGames(query);
    });

    function searchGames(query) {
        fetch(`library.php?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displayResults(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function displayResults(data) {
        resultsContainer.innerHTML = '';
        if (data.results && data.results.length > 0) {
            data.results.forEach(game => {
                const gameElement = document.createElement('div');
                gameElement.classList.add('game');
                gameElement.innerHTML = `
                    <h3>${game.name}</h3>
                    <p>${game.description}</p>
                `;
                resultsContainer.appendChild(gameElement);
            });
        } else {
            resultsContainer.innerHTML = '<p>No results found.</p>';
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Form validation for adding a new topic
    const addTopicForm = document.querySelector(".add-topic-container form");
    if (addTopicForm) {
        addTopicForm.addEventListener("submit", function (event) {
            const title = document.getElementById("title").value.trim();
            const description = document.getElementById("description").value.trim();
            const user = document.getElementById("user").value.trim();

            if (!title || !description || !user) {
                event.preventDefault();
                alert("All fields are required!");
            }
        });
    }

/***********************************//***********************************//***********************************//***********************************/

    // Form validation for adding a new post
    const addPostForm = document.querySelector(".add-post-container form");
    if (addPostForm) {
        addPostForm.addEventListener("submit", function (event) {
            const content = document.getElementById("content").value.trim();
            const user = document.getElementById("user").value.trim();

            if (!content || !user) {
                event.preventDefault();
                alert("All fields are required!");
            }
        });
    }

    // Interactive features can be added here, such as toggling visibility of certain elements, etc.
    // Example: Toggle the visibility of the add topic form
    const addTopicButton = document.querySelector("#add-topic-button");
    const addTopicContainer = document.querySelector(".add-topic-container");

    if (addTopicButton && addTopicContainer) {
        addTopicButton.addEventListener("click", function () {
            addTopicContainer.classList.toggle("visible");
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Smooth scroll to last post anchor
    const lastPostLink = document.querySelector('a[href="#last-post"]');
    if (lastPostLink) {
        lastPostLink.addEventListener("click", function(event) {
            event.preventDefault();
            const posts = document.getElementById('posts');
            const lastPost = posts.lastElementChild;
            if (lastPost) {
                lastPost.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }
});

document.getElementById('logout-btn').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'logout2.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Optionally, show a message or update the page to reflect the logout
            alert('You have logged out.');
            // Optionally, you could also refresh the page to update the UI
            location.reload();
        }
    };
    xhr.send();
});

/***********************************//***********************************//***********************************//***********************************/

document.querySelectorAll(".post-topic").forEach(post => {
	const postId = post.dataset.postId;
	const ratings = post.querySelectorAll(".post-rating");
	const likeRating = ratings[0];

	ratings.forEach(rating => {
		const button = rating.querySelector(".post-rating-button");
		const count = rating.querySelector(".post-rating-count");

		button.addEventListener("click", async () => {
			if (rating.classList.contains("post-rating-selected")) {
				return;
			}

			count.textContent = Number(count.textContent) + 1;

			ratings.forEach(rating => {
				if (rating.classList.contains("post-rating-selected")) {
					const count = rating.querySelector(".post-rating-count");

					count.textContent = Math.max(0, Number(count.textContent) - 1);
					rating.classList.remove("post-rating-selected");
				}
			});

			rating.classList.add("post-rating-selected");

			const likeOrDislike = likeRating === rating ? "like" : "dislike";
			const response = await fetch(`/posts/${postId}/${likeOrDislike}`);
			const body = await response.json();
		});
	});
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.post-rating-button').forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.closest('.post-ratings-container').getAttribute('data-post-id');
            const ratingType = this.getAttribute('data-type');

            fetch('rate_post.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ post_id: postId, rating_type: ratingType })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const countSpan = this.nextElementSibling;
                    countSpan.textContent = parseInt(countSpan.textContent) + 1;
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});



document.getElementById('upvote-count').textContent = Math.floor(Math.random() * 100);
document.getElementById('downvote-count').textContent = Math.floor(Math.random() * 50);