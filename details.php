<?php

$env = file(__DIR__.'/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach($env as $value)
{
  $value = explode('=', $value);  
  define($value[0], $value[1]);
}

$url = 'https://api.github.com/repos/fish1219705/applicationRepo';

$headers[] = 'Content-type: application/json';
$headers[] = 'Authorization: Bearer '.GITHUB_ACCESS_TOKEN;
$headers[] = 'User-Agent: Awesome-Octocat-App   ';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);gg

$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result, true);

// echo '<pre>';
// print_r($result);
// echo '</pre>';

$repo = $result;


$forks_url = 'https://api.github.com/repos/fish1219705/applicationRepo/forks';

    $ch = curl_init(); // Reinitialize cURL
    curl_setopt($ch, CURLOPT_URL, $forks_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $forks_result = curl_exec($ch);
    curl_close($ch); // Close after second request
    
    $forks = json_decode($forks_result, true);

// echo '<pre>';
// print_r($forks_result);
// echo '</pre>';

$fork = $forks;



$branches_url = 'https://api.github.com/repos/fish1219705/applicationRepo/branches';

    $ch = curl_init(); // Reinitialize cURL
    curl_setopt($ch, CURLOPT_URL, $branches_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $branches_result = curl_exec($ch);
    curl_close($ch); // Close after second request

    $branches = json_decode($branches_result, true);

    // echo '<pre>';
    // print_r($branches);
    // echo '</pre>';


$contributors_url = 'https://api.github.com/repos/fish1219705/applicationRepo/contributors';

$ch = curl_init(); // Reinitialize cURL
curl_setopt($ch, CURLOPT_URL, $contributors_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$contributors_result = curl_exec($ch);
curl_close($ch); // Close after second request

$contributors = json_decode($contributors_result, true);

// echo '<pre>';
// print_r($contributors);
// echo '</pre>';


$commits_url = 'https://api.github.com/repos/fish1219705/applicationRepo/commits';
$ch = curl_init(); // Reinitialize cURL
curl_setopt($ch, CURLOPT_URL, $commits_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$commits_result = curl_exec($ch);
curl_close($ch); // Close after second request

$commits = json_decode($commits_result, true);
// echo '<pre>';
// print_r($commits);
// echo '</pre>';



$lans_url = 'https://api.github.com/repos/fish1219705/applicationRepo/languages';
$ch = curl_init(); // Reinitialize cURL
curl_setopt($ch, CURLOPT_URL, $lans_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$lans_result = curl_exec($ch);
curl_close($ch); // Close after second request

$lans = json_decode($lans_result, true);
// echo '<pre>';
// print_r($lans);
// echo '</pre>';
$total_lines = array_sum($lans);




$merges_url = 'https://api.github.com/repos/fish1219705/applicationRepo/merges';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repository Details</title>
    <link rel="stylesheet" href="detail.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="BrickMMO_Logo_Coloured.png" alt="BrickMMO Logo" width="80">
        </div>
        <h1>BrickMMO Application</h1>
        <p class="description">[description]</p>
        <nav>
            <a href="#" class="return-btn">&larr; Return</a>
        </nav>
    </header>
    
    <main>
        <section id="repo-card">
            <div class="repo-image">
                <img src=placeholder.png alt="Repository Image">
            </div>
            <div class="repo-info">
                <div id="repo-brief">
                <h2 id="repo-title"><?php echo $repo['name']; ?></h2>
                <p id="repo-description"><?php echo $repo['description']; ?></p>
                <a id="repo-link" href="<?php echo $repo['html_url']; ?>" target="_blank" class="github-btn">GitHub Link</a>
                </div>
                <div id="repo-details">
                    <h3>Repository Details</h3>
                    <ul>
                        
                        <li><strong>URL:</strong> <span id="repo-url"><?php echo $repo['html_url']; ?></span></li>
                        <li><strong>Language:</strong> <span id="repo-url">
                        <ul>
                        <?php
                       
                        foreach ($lans as $language => $lines) {
                            $percentage = ($lines / $total_lines) * 100; 
                            echo "<li>" . htmlspecialchars($language) . ": " . round($percentage, 2) . "%</li>"; 
                        }
                        ?>
                        </ul>
                        </span></li>
                        <li><strong>Forks:</strong> <span id="forks">
                        <?php 
                        if (!empty($fork)) {
                        $forks_list = array_map(function($f) {
                        return $f['owner']['login'];
                        }, $fork);
                        echo implode(', ', $forks_list);
                        } else {
                        echo "No forks available";
                        }
                        ?>
                        </span></li>
                        <li><strong>Branches:</strong> <span id="branches">
                            <ul>
                            <?php 
                            if (!empty($branches)) {
                                foreach ($branches as $branch) {
                                    echo "<li>" . htmlspecialchars($branch['name']) . "</li>";
                                }
                            } else {
                                echo "<li>No branches available</li>";
                            }
                            ?>
                            </ul>
                        </span></li>
                        <li><strong>Contributors:</strong> <span id="contributors">
                        <ul>
                        <?php 
                            if (!empty($contributors)) {
                                foreach ($contributors as $contributor) {
                                    echo "<li>" . htmlspecialchars($contributor['login']) . " - " . $contributor['contributions'] . " contributions</li>";
                                }
                            } else {
                                echo "<li>No contributors available</li>";
                            }
                            ?>
                        </ul>
                        </span></li>
                        <li><strong>Commits:</strong> <span id="commits">
                        <ul>
                        <?php
                        
                        $contributor_commits = [];
                        foreach ($commits as $commit) {
                            $author = $commit['author']['login']; 

                            
                            if (isset($contributor_commits[$author])) {
                                $contributor_commits[$author]++;
                            } else {
                                
                                $contributor_commits[$author] = 1;
                            }
                        }
                        foreach ($contributor_commits as $author => $commit_count) {
                            echo "<li>" . htmlspecialchars($author) . " - " . $commit_count . " commits</li>";
                        }
                        ?>
                        </ul>
                        </span></li>

                        <li><strong>Merges:</strong> <span id="merges">
                        <ul>
                        <?php
                        foreach ($commits as $commit) {
                            if (strpos($commit['commit']['message'], 'Merge') !== false) {
                                echo "<li><a href='" . htmlspecialchars($commit['html_url']) . "' target='_blank'>"
                                    . htmlspecialchars($commit['commit']['message']) . "</a></li>";
                            }
                        }
                        ?>
                        </ul>
                        </span></li>
                    </ul>
                </div>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="social-icons">
            <a href="https://www.instagram.com/brickmmo/"><img src="instagram.png" alt="Instagram"></a>
            <a href="https://www.youtube.com/channel/UCJJPeP10HxC1qwX_paoHepQ"><img src="youtube.png" alt="Youtube"></a>
            <a href="https://x.com/brickmmo"><img src="twitter.png" alt="Twitter"></a>
            <a href="https://github.com/BrickMMO"><img src="github.png" alt="GitHub"></a>
            <a href="https://www.tiktok.com/@brickmmo"><img src="tiktok.png" alt="TikTok"></a>
        </div>
        <p>&copy; BrickMMO, 2025. All rights reserved.</p>
        <p>LEGO, the LEGO logo and the Minifigure are trademarks of the LEGO Group.</p>
    </footer>
    
    <script src="detail.js"></script>
</body>
</html>
