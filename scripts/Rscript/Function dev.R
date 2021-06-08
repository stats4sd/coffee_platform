library(tidyverse)
library(openxlsx)
library(kableExtra)
library(knitr)
library(scales)
library(flextable)

data <- read.xlsx("example data/Example data 3.xlsx")

countries <- unique(data$country)

indicator_codes <- unique(data$code)

data <- data%>%
  group_by(country, year, source_name, purpose, gender, scope)%>%
  mutate(n = n())%>%
  mutate(group = ifelse(n > 1, row_number(), NA))%>%
  mutate(indicator_definition = "-")%>%
  ungroup()

data%>%
  filter(country == countries[1])%>%
  select(country,purpose, gender, scope, source_name, value_standard, year, group)%>%
  arrange(year)%>%
  mutate(Purpose = paste0(purpose, "\n",
                          "Gender: ", gender, "\n",
                          "Scope: ", scope))%>%
  mutate(source_name = ifelse(!is.na(group), paste0(source_name, " Group:", group), source_name))%>%
  select(-purpose, -scope, -gender, -group)%>%
  pivot_wider(names_from = year, values_from = value_standard)%>%
  mutate_all(as.character)%>%
  rename("Source" = "source_name")%>%
  replace(is.na(.), "-")%>%
  select(-country)%>%
  mutate(Purpose = as.factor(Purpose))%>%
  arrange(Purpose)%>%
  as_grouped_data("Purpose")%>%
  as_flextable()%>%
  add_header_lines(values = countries[1])%>%
  bold(i = ~!is.na(Purpose))%>%
  bg(i = 1, bg = "#A8D08D", part = "header")%>%
  bg(i = 2, bg = "#EDEDED", part = "header")%>%
  bg(i = ~!is.na(Purpose), bg = "#E2EFD9")%>%
  theme_box()%>%
  width(j = 1, width = 3)

data%>%
  filter(country == countries[2])%>%
  select(country,purpose, gender, scope, source_name, value_standard, year, group)%>%
  arrange(year)%>%
  mutate(Purpose = paste0(purpose, "\n",
                          "Gender: ", gender, "\n",
                          "Scope: ", scope))%>%
  mutate(source_name = ifelse(!is.na(group), paste0(source_name, " Group:", group), source_name))%>%
  select(-purpose, -scope, -gender, -group)%>%
  pivot_wider(names_from = year, values_from = value_standard)%>%
  mutate_all(as.character)%>%
  rename("Source" = "source_name")%>%
  replace(is.na(.), "-")%>%
  select(-country)%>%
  mutate(Purpose = as.factor(Purpose))%>%
  arrange(Purpose)%>%
  as_grouped_data("Purpose")%>%
  as_flextable()%>%
  add_header_lines(values = countries[2])%>%
  bold(i = ~!is.na(Purpose))%>%
  bg(i = 1, bg = "#A8D08D", part = "header")%>%
  bg(i = 2, bg = "#EDEDED", part = "header")%>%
  bg(i = ~!is.na(Purpose), bg = "#E2EFD9")%>%
  theme_box()%>%
  width(j = 1, width = 3)

data%>%
  filter(country == countries[3])%>%
  select(country,purpose, gender, scope, source_name, value_standard, year, group)%>%
  arrange(year)%>%
  mutate(Purpose = paste0(purpose, "\n",
                          "Gender: ", gender, "\n",
                          "Scope: ", scope))%>%
  mutate(source_name = ifelse(!is.na(group), paste0(source_name, " Group:", group), source_name))%>%
  select(-purpose, -scope, -gender, -group)%>%
  pivot_wider(names_from = year, values_from = value_standard)%>%
  mutate_all(as.character)%>%
  rename("Source" = "source_name")%>%
  replace(is.na(.), "-")%>%
  select(-country)%>%
  mutate(Purpose = as.factor(Purpose))%>%
  arrange(Purpose)%>%
  as_grouped_data("Purpose")%>%
  as_flextable()%>%
  add_header_lines(values = countries[3])%>%
  bold(i = ~!is.na(Purpose))%>%
  bg(i = 1, bg = "#A8D08D", part = "header")%>%
  bg(i = 2, bg = "#EDEDED", part = "header")%>%
  bg(i = ~!is.na(Purpose), bg = "#E2EFD9")%>%
  theme_box()%>%
  width(j = 1, width = 3)


value_table <- function(data, x, y){
  value_table <- data%>%
    filter(code == x & country == y)%>%
    select(country,purpose, gender, scope, source_name, value_standard, year, group)%>%
    arrange(year)%>%
    mutate(Purpose = paste0(purpose, "\n",
                            "Gender: ", gender, "\n",
                            "Scope: ", scope))%>%
    mutate(source_name = ifelse(!is.na(group), paste0(source_name, " Group:", group), source_name))%>%
    select(-purpose, -scope, -gender, -group)%>%
    pivot_wider(names_from = year, values_from = value_standard)%>%
    mutate_all(as.character)%>%
    rename("Source" = "source_name")%>%
    replace(is.na(.), "-")%>%
    select(-country)%>%
    mutate(Purpose = as.factor(Purpose))%>%
    arrange(Purpose)%>%
    as_grouped_data("Purpose")%>%
    as_flextable()%>%
    add_header_lines(values = y)%>%
    bold(i = ~!is.na(Purpose))%>%
    bg(i = 1, bg = "#A8D08D", part = "header")%>%
    bg(i = 2, bg = "#EDEDED", part = "header")%>%
    bg(i = ~!is.na(Purpose), bg = "#E2EFD9")%>%
    theme_box()%>%
    width(j = 1, width = 3)
  
  return(value_table)
  
}

value_table(data, indicator_codes[1], countries[1])


bar_graph <- function(data, x){
  
  data <- data%>%
    filter(code == x)  
  
  p1 <- data%>%
    ggplot(aes(fill = country, y=value_standard, x = year))+
    geom_col(position = position_dodge2(preserve = "single"))+
    labs(fill = "Country",
         x = "Year",
         y = paste0(data$name, " (", data$unit_standard[1], ")"),
         title = paste(data$code, " ", data$name))+
    scale_fill_brewer(palette = "Dark2")+
    theme_light()
  
  if(data$value_standard[1] == "%"){
    
    p1 <- scale_y_continuous(labels = percent)
    
  }else{}
  
  return(p1)
  
}

bar_graph(data, indicator_codes[1])


#definition table
t <-data%>%
  select(source_name, source_partner, indicator_name_original, indicator_definition)%>%
  group_by(source_name)%>%
  slice(1)
  
t <- flextable(t)%>%
  set_header_labels(source_name = "Source",
                    source_partner = "Source Partner",
                    indicator_name_original = "Original Indicator Name",
                    indicator_definition = "Indicator Definition")%>%
  bg(i = 1, bg = "#A8D08D", part = "header")%>%
  theme_box()%>%
  width(j = 1:4, width = c(2,1,1,2))

t

definition_table <- function(data, x){
  t <-data%>%
    filter(code == x)%>%
    select(source_name, source_partner, indicator_name_original, indicator_definition)%>%
    group_by(source_name)%>%
    slice(1)
  
  definition_table <- flextable(t)%>%
    set_header_labels(source_name = "Source",
                      source_partner = "Source Partner",
                      indicator_name_original = "Original Indicator Name",
                      indicator_definition = "Indicator Definition")%>%
    bg(i = 1, bg = "#A8D08D", part = "header")%>%
    theme_box()%>%
    width(j = 1:4, width = c(2,1,1,2))
  
  return(definition_table)
  
}

definition_table(data, indicator_codes[1])

report_characteristics <- function(data){
  report_characteristics <- data.frame(
    Detail = c(
      rep("Country", length(unique(data$country))),
      rep("Years", length(unique(data$year))),
      rep("Source Type", length(unique(data$source_partner_type))),
      rep("Purpose", length(unique(data$purpose))),
      rep("Gender", length(unique(data$gender))),
      rep("Scope", length(unique(data$scope)))),
    Value = c(
      unique(data$country),
      unique(data$year),
      unique(data$source_partner_type),
      unique(data$purpose),
      unique(data$gender),
      unique(data$scope)
    )
  )
  
  report_characteristics <- flextable(report_characteristics)%>%
    set_header_labels(Detail = "Report Characteristics",
                      Value = "Report Characteristics")%>%
    merge_v(j = 1)%>%
    merge_h(part = "header")%>%
    bg(i = 1, bg = "#A8D08D", part = "header")%>%
    theme_box()%>%
    autofit()
  
  return(report_characteristics)
}

report_characteristics(data)

table <- data.frame(
  col1 = c("Country", "Years", "Source Type", "Purpose", "Gender", "Scope"),
  col2 = c(
    gsub('"', '',paste(shQuote(unique(data$country)), collapse=", ")),
    gsub('"', '',paste(shQuote(unique(data$year)), collapse=", ")),
    gsub('"', '',paste(shQuote(unique(data$source_partner_type)), collapse=", ")),
    gsub('"', '',paste(shQuote(unique(data$purpose)), collapse=", ")),
    gsub('"', '',paste(shQuote(unique(data$gender)), collapse=", ")),
    gsub('"', '',paste(shQuote(unique(data$scope)), collapse=", "))
  )
)




