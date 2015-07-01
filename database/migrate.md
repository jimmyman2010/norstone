/* category */
INSERT INTO norstone.tbl_category (id, `name`, `description`, seo_title, seo_keyword, seo_description, parent_id, activated, sorting)
SELECT id, `name`, seo_link, meta_tit, meta_key, meta_des, parent, `status`, sort
FROM vitinhgiatot.`tbl_product_category`
WHERE lang = 'vn'

/* product */
INSERT INTO norstone.tbl_product (id, `name`, `description`, general, info_tech, category_id, price, price_new, activated, created_date, published_date, `status`, viewed, created_by)
SELECT id, `name`, detail_short, detail_2, detail, parent, price, price_2, `status`, UNIX_TIMESTAMP(date_added), UNIX_TIMESTAMP(date_added), 'published', luotxem, 'system'
FROM vitinhgiatot.`tbl_product`
WHERE lang = 'vn'

/* product_category */
INSERT INTO norstone.tbl_product_category (product_id, category_id, deleted)
SELECT id, parent, 0
FROM vitinhgiatot.`tbl_product`
WHERE lang = 'vn'