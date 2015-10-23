
/* news */
INSERT INTO vitinhgiatot.tbl_content (id, `name`, slug, summary, content, created_date, published_date)
SELECT id, `name`, `name`, detail_short, detail, date_added, date_added
FROM vitinh.`tbl_news`
WHERE lang = 'vn'

/* category */
INSERT INTO vitinhgiatot.tbl_category (id, `name`, `slug`, `description`, seo_title, seo_keyword, seo_description, parent_id, activated, sorting)
SELECT id, `name`, `name`, seo_link, meta_tit, meta_key, meta_des, parent, `status`, sort
FROM vitinh.`tbl_product_category`
WHERE lang = 'vn'

/* product */
INSERT INTO vitinhgiatot.tbl_product (id, `name`, `slug`, `description`, general, info_tech, price, activated, created_date, published_date, `status`, viewed, created_by)
SELECT id, `name`, `name`, detail_short, detail_2, detail, price, `status`, UNIX_TIMESTAMP(date_added), UNIX_TIMESTAMP(date_added), 'instock', luotxem, 'system'
FROM vitinh.`tbl_product`
WHERE lang = 'vn'

/* product_category */
INSERT INTO vitinhgiatot.tbl_product_category (product_id, category_id, deleted)
SELECT id, parent, 0
FROM vitinh.`tbl_product`
WHERE lang = 'vn'

/* product */
INSERT INTO vitinhgiatot.tbl_arrangement (id, `content_id`, `content_type`, `sorting`)
SELECT id, `product_id`, 'product', `sort`
FROM vitinh.`tbl_product_special`
WHERE lang = 'vn'
