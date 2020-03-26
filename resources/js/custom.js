{
    
    window.onload = () => {
        const tweetsElement = document.querySelector('.tweets');
        const tweetsListElement = document.querySelector('.tweets-list');

        tweetsElement.scroll({
            top: tweetsListElement.scrollHeight + 50,
            left: 0,
            behavior: 'smooth'
            
        })
    };









}