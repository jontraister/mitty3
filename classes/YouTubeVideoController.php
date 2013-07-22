<?php

/**
 * Renders youtube videos from a channel or playlist
 */
class YouTubeVideoController extends PageSetController
{

    protected function getContentVars($fileName, $args)
    {
        $vars = parent::getContentVars($fileName, $args);
        $selected = $vars ['selected'] = $this->getSelected($args);

        $queryType = $vars['youtube']['query']['type'];
        $queryId = $vars['youtube']['query']['id'];

        try {
            $youtube = $this->getProxy($vars['youtube']['googleapi_key']);

            switch ($queryType) {
                case 'channel':
                    $vars['items'] = $this->loadChannel($youtube, $queryId);
                    break;
                case 'playlist':
                    $vars['items'] = $this->loadPlaylist($youtube, $queryId);
                    break;

                default:
                    throw new Exception("Unknown youtube query type '$queryType'!");
                    break;
            }

            if (isset($vars['items'])) {
                $vars['og']['title']= $vars['meta']['title']= $vars['meta']['title'] . ' | ' . $vars['items'][$selected]['title'];
                if (isset($vars['items'][$selected]['description']))
                    $vars['og']['description']=$vars['meta']['description']=$vars['items'][$selected]['description'];
             }

        } catch (Exception $e) {
            error_log(get_class($e) . ': ' . $e->getMessage());
            $vars['error'] = "An error occurred pulling the $queryType. Please come back later";
        }


        return $vars;
    }

    /**
     * Get playlist.
     *
     * @param Google_YoutubeService  $youtube
     * @param string $id playlist id
     * @return array list of videos
     */
    protected function loadPlaylist($youtube, $id,$max=20)
    {
        $result = $youtube->playlistItems->listPlaylistItems('contentDetails', array('playlistId' => $id,
            'fields' => 'items(contentDetails)',
            'maxResults' => $max)
        );

        $ids=array_map(function ($item) {return $item['contentDetails']['videoId'];}, $result['items']);

        $result = $youtube->videos->listVideos(join(',', $ids), 'snippet');

        $videos = array();
        foreach ($result['items'] as $item) {

            $videos[] = array(
                'url' => 'http://www.youtube.com/embed/' . $item['id'] . '?autoplay=1&rel=0',
                'title' => $item['snippet']['title'],
                'description' => $item['snippet']['description'],
                'thumb' => $item['snippet']['thumbnails']['high']['url'],
                'publishedAt' => $item['snippet']['publishedAt'],
                'id'=>$item['id']
            );
        }

        return $videos;
    }

    /**
     * Get Channel uploads.
     *
     * @param Google_YoutubeService  $youtube
     * @param string $id channel id
     * @return array list of videos
     */
    protected function loadChannel($youtube, $id)
    {
        $result = $youtube->channels->listChannels('contentDetails', array('id' => $id));

        $playlist=@$result['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

        return $this->loadPlaylist($youtube, $playlist,8);
    }

    /**
     * Get Youtube API proxy.
     *
     * @param string $key
     * @return Google_YoutubeService
     */
    protected function getProxy($key)
    {

        require_once 'lib/google-api-php-client/src/Google_Client.php';
        require_once 'lib/google-api-php-client/src/contrib/Google_YouTubeService.php';

        $client = new Google_Client();
        $client->setDeveloperKey($key);

        return new Google_YoutubeService($client);
    }

    /**
     * Get page content data.
     *
     * @return array
     */
    protected function addMeta($data)
    {

        $data = parent::addMeta($data);

        $content= $data['content']['vars'];

        if (isset($content['items'])) {
            $data['og']['image']=$content['items'][$content['selected']]['thumb'];
            $data['og']['video']= $content['items'][$content['selected']];
        }

        return $data;
    }

}
