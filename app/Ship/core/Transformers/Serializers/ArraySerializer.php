<?php

/*
 * This file is part of the League\Fractal package.
 *
 * (c) Phil Sturgeon <me@philsturgeon.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Apiato\Core\Transformers\Serializers;

use Illuminate\Pagination\UrlWindow;
use League\Fractal\Pagination\CursorInterface;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\SerializerAbstract;

class ArraySerializer extends SerializerAbstract
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return [$resourceKey ?: 'data' => $data];
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return $data;
    }

    /**
     * Serialize null resource.
     *
     * @return array
     */
    public function null()
    {
        return [];
    }

    /**
     * Serialize the included data.
     *
     * @param ResourceInterface $resource
     * @param array             $data
     *
     * @return array
     */
    public function includedData(ResourceInterface $resource, array $data)
    {
        return $data;
    }

    /**
     * Serialize the meta.
     *
     * @param array $meta
     *
     * @return array
     */
    public function meta(array $meta)
    {
        if (empty($meta)) {
            return [];
        }

        return ['meta' => $meta];
    }

    /**
     * Serialize the paginator.
     *
     * @param PaginatorInterface $paginator
     *
     * @return array
     */
    public function paginator(PaginatorInterface $paginator)
    {
        $onEachSide = 3;

        $currentPage = (int) $paginator->getCurrentPage();
        $lastPage = (int) $paginator->getLastPage();

        $pagination = [
            'total' => (int) $paginator->getTotal(),
            'count' => (int) $paginator->getCount(),
            'per_page' => (int) $paginator->getPerPage(),
            'current_page' => $currentPage,
            'total_pages' => $lastPage,
        ];

        $pagination['links'] = [];

        $temp = $currentPage + $onEachSide;
        $start = $currentPage - $onEachSide;
        $end = $temp > $lastPage ? $lastPage : $temp;

        $pagination['links'] = $this->getUrlRange($start, $end, $paginator);

        if (empty($pagination['links'])) {
            $pagination['links'] = (object) [];
        }

        return ['pagination' => $pagination];
    }

    /**
     * Serialize the cursor.
     *
     * @param CursorInterface $cursor
     *
     * @return array
     */
    public function cursor(CursorInterface $cursor)
    {
        $cursor = [
            'current' => $cursor->getCurrent(),
            'prev' => $cursor->getPrev(),
            'next' => $cursor->getNext(),
            'count' => (int) $cursor->getCount(),
        ];

        return ['cursor' => $cursor];
    }

    public function getUrlRange($start, $end, $paginator)
    {
        $start = $start > 0 ? $start : 1;
        $end = $end > 0 ? $end : 1;
        $collect =  collect(range($start, $end))->map(function ($page) use ($paginator) {
            return [
                'url' => $paginator->getUrl($page),
                'label' => (string) ($page > 0 ? $page : 1),
                'active' => $paginator->getCurrentPage() === $page,
            ];
        });
        if($paginator->getCurrentPage() > 1) {
            $collect->prepend([
                'url' => $paginator->getUrl($paginator->getCurrentPage() - 1),
                'label' => function_exists('__') ? __('pagination.previous') : 'Previous',
                'active' => false,
            ]);
        }
        if($paginator->getCurrentPage() < $end) {
            $collect->push([
                'url' => $paginator->getUrl($paginator->getCurrentPage() + 1),
                'label' => function_exists('__') ? __('pagination.next') : 'Next',
                'active' => false,
            ]);
        }

        return $collect;
    }
}
