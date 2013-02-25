<?php
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

// set class namespace
namespace PequenoSpotifyModule\Item;

class Artist extends AbstractItem
{

    /** @var Album[] */
    protected $_albums = null;

    /**
     * Initialize datas
     * @access protected
     * @return AbstractItem
     */
    protected function initialize()
    {
        // call parent method
        parent::initialize();

        // initialize specific datas
        $this->_albums = array();
    }

    /**
     * Set artist albums
     * @access public
     * @param  Album[] $albums Artist albums
     * @return Artist
     */
    public function setAlbums($albums)
    {
        // store albums and return self
        $this->_albums = (array) $albums;

        return $this;
    }

    /**
     * Get artist albums
     * @access public
     * @return Album[]
     */
    public function getAlbums()
    {
        // return artist albums
        return (array) $this->_albums;
    }

    /**
     * Extract Artist informations from object
     * @access public
     * @static
     * @param  \stdClass $artist Object represent Artist
     * @return Artist
     */
    public static function extractInfos($artist)
    {
        // create Artist instance
        $artistItem = new self();

        // update informations
        $artistItem->setUri((string) $artist->href);
        $artistItem->setName((string) $artist->name);

        // is popularity available ?
        if (isset($artist->popularity)) {

            // update popularity
            $artistItem->setPopularity((float) $artist->popularity);
        }

        // is albums available ?
        if (isset($artist->albums) && is_array($artist->albums)) {

            // setup container
            $albums	= array();

            // iterate albums
            foreach ($artist->albums as $album) {

                // create Album and store on container
                $albums[] = Album::extractInfos($album);
            }

            // set albums of artist
            $artistItem->setAlbums($albums);
        }

        // return artist instance
        return $artistItem;
    }

}
